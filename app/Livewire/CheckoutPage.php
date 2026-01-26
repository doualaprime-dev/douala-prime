<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutPage extends Component
{
    public function render()
    {
        return view('livewire.checkout-page')
        ->layout('components.layouts.front-end-layout', [
            'title' => 'Checkout'
        ]);;
    }
}
