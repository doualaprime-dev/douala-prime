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
            ->limit(5)
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
            ->limit(5)
            ->get();

        $refrigerateurs = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 1)
            ->latest()
            ->limit(5)
            ->get();

        $congelateurs = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 2)
            ->latest()
            ->limit(5)
            ->get();

        $cuisinieres = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 3)
            ->latest()
            ->limit(5)
            ->get();

        $machines_a_laver = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 4)
            ->latest()
            ->limit(5)
            ->get();

        $climatiseurs = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 5)
            ->latest()
            ->limit(5)
            ->get();

        $televisions = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 6)
            ->latest()
            ->limit(5)
            ->get();

        $appareils_de_cuisson = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 7)
            ->latest()
            ->limit(5)
            ->get();

        $blender_et_hachoir = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 8)
            ->latest()
            ->limit(5)
            ->get();

        $appareils_de_patisserie_et_jus = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 9)
            ->latest()
            ->limit(5)
            ->get();

        $appareils_pour_petit_dej = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 10)
            ->latest()
            ->limit(5)
            ->get();

        $appareils_de_menage = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 11)
            ->latest()
            ->limit(5)
            ->get();

        $audio_et_hifi = Product::active()
            ->inStock()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('category_id', 12)
            ->latest()
            ->limit(5)
            ->get();

        return view('livewire.home-page',[
            'featuredProducts' => $featuredProducts,
            'brands' => $brands,
            'categories' => $categories,
            'newArrivals' => $newArrivals,
            'refrigerateurs' => $refrigerateurs,
            'congelateurs' => $congelateurs,
            'cuisinieres' => $cuisinieres,
            'machines_a_laver' => $machines_a_laver,
            'climatiseurs' => $climatiseurs,
            'televisions' => $televisions,
            'appareils_de_cuisson' => $appareils_de_cuisson,
            'blender_et_hachoir' => $blender_et_hachoir,
            'appareils_de_patisserie_et_jus' => $appareils_de_patisserie_et_jus,
            'appareils_pour_petit_dej' => $appareils_pour_petit_dej,
            'appareils_de_menage' => $appareils_de_menage,
            'audio_et_hifi' => $audio_et_hifi,
        ])->layout('components.layouts.front-end-layout');
    }
}
