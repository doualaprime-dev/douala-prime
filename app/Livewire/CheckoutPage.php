<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $cart = [];
    public $step = 1; // 1: Address, 2: Review, 3: Payment
    public $useExistingAddress = true;
    public $selectAddressId = null;
    public $full_name = '';
    public $phone = '';
    public $address_line_1 = '';
    public $address_line_2 = '';
    public $city = '';
    public $state = '';
    public $postal_code = '';
    public $country = 'US';

    // Order details
    public $couponCode = '';
    public $appliedCoupon = null;
    public $paymentMethod = 'stripe';
    public $customerNotes = '';

    public function mount()
    {
        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            return redirect()->route('cart.index');
        }

        // Pre-fill with customer data
        $customer = auth('customer')->user();
        $this->full_name = $customer->name;
        $this->phone = $customer->phone ?? '';

        // Load default address if exists
        $defaultAddress = $customer->addresses()->where('is_default', true)->first();
        if ($defaultAddress) {
            $this->selectAddressId = $defaultAddress->id;
        }
    }

    public function selectAddress($addressId)
    {
        $this->selectAddressId = $addressId;
    }

    public function applyCoupon()
    {
        $coupon = Coupon::where('code', strtoupper($this->couponCode))
            ->valid()
            ->first();

        if (!$coupon) {
            session()->flash('coupon_error', 'Invalid or expired coupon code');
            return;
        }

        if (!$coupon->canBeUsedByCustomer(auth('customer')->id())) {
            session()->flash('coupon_error', 'You have already used this coupon');
            return;
        }

        $this->appliedCoupon = $coupon;
        session()->flash('coupon_success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        $this->appliedCoupon = null;
        $this->couponCode = '';
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validateAddress();
            $this->step = 2;
        } elseif ($this->step === 2) {
            $this->step = 3;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    protected function validateAddress()
    {
        if (!$this->useExistingAddress) {
            $this->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'address_line_1' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:2',
            ]);
        } elseif (!$this->selectAddressId) {
            throw new \Exception('Please select an address');
        }
    }

    public function placeOrder()
    {
        try {
            DB::beginTransaction();

            // Get shipping address
            if ($this->useExistingAddress && $this->selectAddressId) {
                $address = Address::find($this->selectAddressId);
                $shippingData = [
                    'shipping_full_name' => $address->full_name,
                    'shipping_phone' => $address->phone,
                    'shipping_address_line_1' => $address->address_line_1,
                    'shipping_address_line_2' => $address->address_line_2,
                    'shipping_city' => $address->city,
                    'shipping_state' => $address->state,
                    'shipping_postal_code' => $address->postal_code,
                    'shipping_country' => $address->country,
                ];
            } else {
                $shippingData = [
                    'shipping_full_name' => $this->full_name,
                    'shipping_phone' => $this->phone,
                    'shipping_address_line_1' => $this->address_line_1,
                    'shipping_address_line_2' => $this->address_line_2,
                    'shipping_city' => $this->city,
                    'shipping_state' => $this->state,
                    'shipping_postal_code' => $this->postal_code,
                    'shipping_country' => $this->country,
                ];
            }

            // Calculate totals
            $subtotal = $this->getSubtotal();
            $shippingCost = $this->getShippingCost();
            $discountAmount = $this->getDiscountAmount();
            $taxAmount = 0; // You can calculate tax here if needed
            $total = $subtotal + $shippingCost + $taxAmount - $discountAmount;

            // create order
            $order = Order::create([
                'customer_id' => auth('customer')->id(),
                'coupon_id' => $this->appliedCoupon?->id,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $taxAmount,
                'total' => $total,
                'payment_method' => $this->paymentMethod,
                'payment_status' => 'pending',
                'status' => 'pending',
                'customer_notes' => $this->customerNotes,
            ] + $shippingData);

            // create order items
            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'],
                    'product_name' => $item['name'],
                    'product_sku' => $item['variant_id']
                        ? \App\Models\ProductVariant::find($item['variant_id'])->sku
                        : \App\Models\Product::find($item['product_id'])->sku,
                    'variant_name' => $item['variant_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            // record the coupon usage
            if ($this->appliedCoupon) {
                $this->appliedCoupon->usages()->create([
                    'customer_id' => auth('customer')->id(),
                    'order_id' => $order->id,
                ]);
            }

            DB::commit();

            // send order confirmation

            // processing the payment
            if ($this->paymentMethod === 'stripe') {
                return $this->processStripePayment($order);
            } else {
                // Cash on delivery
                session()->forget('cart');
                return redirect()->route('customer.orders.show', $order->id)
                    ->with('succes', 'Order placed successfully!');
            }

        } catch (\Exception $e) {
            // throw $th;
        }
    }

    protected function processStripePayment($order)
    {

    }

    protected function getSubtotal()
    {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cart));
    }

    protected function getShippingCost()
    {
        $subtotal = $this->getSubtotal();
        $freeShippingThreshold = Setting::get('free_shipping_threshold', 100);
        $flatRate = Setting::get('flat_shipping_rate', 10);

        if ($freeShippingThreshold && $subtotal >= $freeShippingThreshold) {
            return 0;
        }

        return $flatRate;
    }

    protected function getDiscountAmount()
    {
        if (!$this->appliedCoupon) {
            return 0;
        }

        return $this->appliedCoupon->calculateDiscount($this->getSubtotal());
    }

    public function render()
    {
        return view('livewire.checkout-page')
        ->layout('components.layouts.front-end-layout', [
            'title' => 'Checkout'
        ]);;
    }
}
