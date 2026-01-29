<div class="bg-gray-50 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-yellow-500">Accueil</a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-yellow-500">Boutique</a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-gray-500 hover:text-yellow-500">{{ $product->category->name }}</a>
                </li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900 font-medium">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 p-8">
                <!-- Images -->
                <div>
                    <!-- Main Image -->
                    <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-4">
                        @if ($selectedImage)
                            <img src="{{ asset('storage/' . $selectedImage) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br">

                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Images -->
                    @if ($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($product->images as $image)
                                <button wire:click="selectImage('{{ $image->image_path }}')"
                                    class="aspect-square rounded-lg overflow-hidden border-2 {{ $selectedImage === $image->image_path ? 'border-blue-600' : 'border-gray-200' }} hover:border-yellow-400 transition">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if ($product->is_featured)
                            <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded">
                                En vedette
                            </span>
                        @endif

                        @if ($product->stock_status === 'in_stock')
                            <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded">
                                En stock
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded">
                                En rupture de stock
                            </span>
                        @endif
                    </div>

                    <!-- Brand -->
                    @if ($product->brand)
                        <p class="text-sm text-gray-500 mb-2">{{ $product->brand->name }}</p>
                    @endif

                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <!-- Rating -->
                    @if ($product->reviews_count > 0)
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($product->average_rating))
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-600">{{ number_format($product->average_rating, 1) }}</span>
                        </div>
                    @endif

                    <!-- Price -->
                    <div class="mb-6">
                        @if ($selectedVariant)
                            @php
                                $variant = $product->variants->find($selectedVariant);
                            @endphp

                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-bold text-gray-900">{{ number_format($variant->price, 3) }} F CFA</span>

                                @if ($variant->compare_price)
                                    <span class="text-xl text-gray-500 line-through">{{ number_format($variant->compare_price, 3) }} F CFA</span>
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-semibold">
                                        -{{ $variant->discount_percentage }}%
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-bold text-gray-900">{{ number_format($variant->price, 2) }} F CFA</span>

                                @if ($variant->compare_price)
                                    <span class="text-xl text-gray-500 line-through">{{ number_format($variant->compare_price, 2) }} F CFA</span>
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-semibold">
                                        -{{ $variant->discount_percentage }}%
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Short Description -->
                    @if ($product->short_description)
                        <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>
                    @endif

                    <!-- Variants -->
                    {{-- @if ($product->has_variants && $product->variants->isNotEmpty())
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-900 mb-3">Select Variant:</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($product->variants->where('is_active', true) as $variant)
                                    <button wire:click="selectedVariant({{ $variant->id }})"
                                            class="border-2 rounded-lg p-3 text-left transition {{ $selectedVariant === $variant->id ? 'border-blue-600 bg-indigo-50' : 'border-gray-300 hover:border-indigo-400' }}">
                                        <p class="font-medium text-gray-900">{{ $variant->name }}</p>
                                        <p class="text-sm text-gray-600">{{ number_format($variant->price, 2) }}</p>
                                        <p class="text-xs {{ $variant->stock_status === 'in_stock' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $variant->stock_status === 'in_stock' ? 'In Stock' : 'Out of Stock' }}
                                        </p>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif --}}

                    <!-- Quantity -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-3">Quantité:</label>
                        <div class="flex items-center gap-3">
                            <button wire:click="decrementQuantity" class="w-10 h-10 rounded-lg border border-gray-300 hover:bg-gray-100 flex items-center justify-center font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <input  type="number"
                                    wire:model="quantity"
                                    min="1"
                                    class="w-20 text-center border border-gray-300 rounded-lg py-2 justify-center">
                            <button wire:click="incrementQuantity" class="w-10 h-10 rounded-lg border border-gray-300 hover:bg-gray-100 flex items-center font-semibold justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>

                            <div wire:loading>
                                <svg class="text-gray-300 animate-spin" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24">
                                    <path
                                    d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                                    stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                    d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                                    stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-900">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Flash Messages -->
                    @if (session()->has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Add to Cart -->
                    @if ($product->stock_status === 'in_stock')
                        <button wire:click="addToCart" class="w-full bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition">
                            Ajouter au panier
                        </button>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed font-medium">
                            En rupture de stock
                        </button>
                    @endif

                    <!-- Products Details -->
                    <div class="mt-8 border-t pt-6 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">SKU:</span>
                            <span class="font-medium">{{ $product->sku }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Categorie:</span>
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="font-medium text-yellow-500 hover:text-yellow-600">
                                {{ $product->category->name }}
                            </a>
                        </div>
                        @if ($product->brand)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Marque:</span>
                                <a href="{{ route('products.index', ['brand' => $product->brand->slug]) }}" class="font-medium text-yellow-500 hover:text-yellow-600">
                                    {{ $product->brand->name }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs: Description & Reviews -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8" x-data="{ activeTab: 'description' }">
            <!-- Tab Headers -->
            <div class="border-b">
                <nav class="flex">
                    <button @click="activeTab = 'description'"
                            :class="{ 'border-yellow-500 text-yellow-500': activeTab === 'description' }"
                            class="px-6 py-4 border-b-2 font-medium transition">
                        Description
                    </button>
                    <button @click="activeTab = 'reviews'"
                            :class="{ 'border-yellow-500 text-yellow-500': activeTab === 'reviews' }"
                            class="px-6 py-4 border-b-2 font-medium transition">
                        Avis {{{ $product->reviews_count }}}
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                <!-- Description Tab -->
                <div x-show="activeTab === 'description'" x-cloak>
                    <div class="prose max-w-none">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div x-show="activeTab === 'reviews'" x-cloak>
                    @if($product->approvedReviews->count() > 0)
                        <div class="space-y-6">
                            @foreach ($product->approvedReviews as $review)
                                <div class="border-b pb-6 last:border-b-0">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold">
                                                {{ substr($review->customer->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h4 class="font-semibold">{{ $review->customer->name }}</h4>
                                                @if ($review->is_verified_purchase)
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                                        Achat vérifié
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-2 mb-2">
                                                <div class="flex text-yellow-400">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>

                                            @if ($review->title)
                                                <h5 class="font-medium mb-2">{{ $review->title }}</h5>
                                            @endif
                                            @if ($review->comment)
                                                <p class="font-medium mb-2">{{ $review->comment }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Aucun avis pour le moment. Soyez le premier à donner votre avis sur ce produit !</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits associés</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $relatedProduct)
                        <livewire:product-card :product="$relatedProduct" :key="'related-' . $relatedProduct->id" lazy />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
