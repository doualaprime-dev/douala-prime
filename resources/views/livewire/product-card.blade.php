<div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <!-- Product Image -->
        <div class="aspect-square overflow-hidden bg-gray-200">
            @if ($product->primaryImage)
                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                    <span class="text-6xl text-gray-500">{{ substr($product->name, 0, 1) }}</span>
                </div>
            @endif
        </div>

        <!-- Badges -->
        <div class="absolute top-2 left-2 flex flex-col gap-2">
            @if ($product->is_featured)
                <span class="bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded">
                    En vedette
                </span>
            @endif

            @if ($product->discount_percentage > 0)
                <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
                    -{{ $product->discount_percentage }}%
                </span>
            @endif

            @if ($product->is_featured)
                <span class="bg-gray-800 text-white text-xs font-semibold px-2 py-1 rounded">
                    En rupture de stock
                </span>
            @endif
        </div>

        <!-- Product Info -->
        <div class="p-4">
            <!-- Category -->
            <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>

            <!-- Product Name -->
            <h3 class="font-semibold text-sm text-gray-900 mb-2 line-clamp-2 group-hover:text-yellow-600 transition">
                {{ $product->name }}
            </h3>

            <!-- Rating -->
            @if ($product->reviews_count > 0)
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($product->average_rating))
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-4 h-4 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-xs text-gray-600">{{ $product->reviews_count }}</span>
                </div>
            @endif

            <!-- Price -->
            <div class="flex items-center gap-1">
                <span class="text-sm font-bold text-gray-900">
                    {{ number_format($product->price, 3) }} FCFA
                </span>

                @if ($product->compare_price)
                    <span class="text-xs line-through text-gray-500">
                        {{ number_format($product->compare_price, 3) }} FCFA
                    </span>
                @endif
            </div>
        </div>
    </a>

    <!-- Add to Cart Button -->
    @if ($product->stock_status === 'in_stock')
        <div class="p-4 pt-0">
            <button wire:click="addToCart" class="w-full space-x-2 flex items-center justify-center text-xs cursor-pointer bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition">
                <div wire:loading>
                    <svg class="text-gray-300 animate-spin" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16">
                        <path
                        d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                        d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-900">
                        </path>
                    </svg>
                </div>
                <div>
                    Ajouter au panier
                </div>
            </button>
        </div>
    @else
        <div class="p-4 pt-0">
            <button disabled class="w-full text-xs bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed font-medium">
                En rupture de stock
            </button>
        </div>
    @endif
</div>
