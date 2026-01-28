<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';

    public function render()
    {
        $categories = Category::active()
            ->sorted()
            ->withCount('products')
            ->limit(6)
            ->get();

        $products = Product::where('name', 'like', '%' . $this->search . '%')->with(['category', 'brand', 'primaryImage'])->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.search-bar', [
            'categories' => $categories,
            'products' => $products,
        ])->layout('components.layouts.front-end-layout');
    }
}
