<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: rgb(43, 43, 228);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .order-details {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .item {
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 0;
        }
        .item:last-child {
            border-bottom: none;
        }
        .total {
            background: #4F46E5;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background: #4F46E5;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Merci pour votre commande !</h1>
    </div>

    <div class="content">
        <p>Hi {{ $order->customer->name }},</p>

        <p>Nous avons bien reçu votre commande et nous la préparons. Nous vous informerons dès son expédition !</p>

        <div class="order-details">
            <h2 style="margin-top: 0;">Détails de la commande</h2>
            <p><strong>N° Commande:</strong> {{ $order->order_number }}</p>
            <p><strong>Date de commande:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
            <p><strong>Mode de paiement:</strong> {{ $order->payment_method === 'stripe' ? 'Credit/Debit Card' : 'Cash on Delivery' }}</p>
            <p><strong>État du paiement:</strong> {{ ucfirst($order->payment_status) }}</p>
        </div>

        <h3>Articles commandés</h3>
        @foreach($order->items as $item)
            <div class="item">
                <strong>{{ $item->product_name }}</strong>
                @if($item->variant_name)
                    <br><span style="color: #6b7280;">{{ $item->variant_name }}</span>
                @endif
                <br>Quantité: {{ $item->quantity }} * {{ number_format($item->price, 3) }}
                <br><strong>{{ number_format($item->subtotal, 3) }}</strong>
            </div>
        @endforeach

        <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e5e7eb;">
            <table width="100%" style="margin-top: 10px;">
                <tr>
                    <td>Sous-total:</td>
                    <td align="right">{{ number_format($order->subtotal, 3) }}</td>
                </tr>
                @if($order->discount_amount > 0)
                <tr>
                    <td style="color: #059669;">Rabais:</td>
                    <td align="right" style="color: #059669;">-{{ number_format($order->discount_amount, 3) }} F CFA</td>
                </tr>
                @endif
                <tr>
                    <td>Expédition:</td>
                    <td align="right">
                        @if($order->shipping_cost > 0)
                            {{ number_format($order->shipping_cost, 3) }}
                        @else
                            <span style="color: #059669;">GRATUITE</span>
                        @endif
                    </td>
                </tr>
                @if($order->tax_amount > 0)
                <tr>
                    <td>Taxe:</td>
                    <td align="right">{{ number_format($order->tax_amount, 3) }} F CFA</td>
                </tr>
                @endif
            </table>
        </div>

        <div class="total">
            <table width="100%">
                <tr>
                    <td><strong style="font-size: 18px;">Total:</strong></td>
                    <td align="right"><strong style="font-size: 24px;">{{ number_format($order->total, 3) }}</strong></td>
                </tr>
            </table>
        </div>

        <h3>Adresse de livraison</h3>
        <p>
            {{ $order->shipping_full_name }}<br>
            {{ $order->shipping_phone }}<br>
            {{ $order->shipping_address_line_1 }}<br>
            @if($order->shipping_address_line_2)
                {{ $order->shipping_address_line_2 }}<br>
            @endif
            {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
            {{ $order->shipping_country }}
        </p>

        <div style="text-align: center;">
            <a href="{{ route('customer.orders.show', $order->id) }}" class="button">
                Voir les détails de la commande
            </a>
        </div>

        @if($order->customer_notes)
            <div style="background: #fef3c7; padding: 15px; border-radius: 8px; margin-top: 20px;">
                <strong>Vos notes:</strong><br>
                {{ $order->customer_notes }}
            </div>
        @endif
    </div>
</body>
