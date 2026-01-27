<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class HomePage extends Component
{
    public function render()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->limit(8)
            ->get();

        $categories = Category::active()
            ->sorted()
            ->withCount('products')
            ->limit(6)
            ->get();

        $brands = Brand::active()
            ->sorted()
            ->withCount('products')
            ->limit(6)
            ->get();

        $newArrivals = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->latest()
            ->limit(8)
            ->get();

        return view('livewire.home-page',[
            'featuredProducts' => $featuredProducts,
            'brands' => $brands,
            'categories' => $categories,
            'newArrivals' => $newArrivals
        ])->layout('components.layouts.front-end-layout');
    }
}
