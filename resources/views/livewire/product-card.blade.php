<div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
    <a href="{{ route('products.show', $product->slug) }} " class="block">
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
                    Featured
                </span>
            @endif

            @if ($product->discount_percentage > 0)
                <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
                    -{{ $product->discount_percentage }}%
                </span>
            @endif

            @if ($product->is_featured)
                <span class="bg-gray-800 text-white text-xs font-semibold px-2 py-1 rounded">
                    Out of Stock
                </span>
            @endif
        </div>

        <!-- Product Info -->
        <div class="p-4">
            <!-- Category -->
            <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>

            <!-- Product Name -->
            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
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
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-gray-900">
                    {{ number_format($product->price, 2) }} F CFA
                </span>

                @if ($product->compare_price)
                    <span class="text-sm line-through text-gray-500">
                        {{ number_format($product->price, 2) }} F CFA
                    </span>
                @endif
            </div>
        </div>
    </a>

    <!-- Add to Cart Button -->
    @if ($product->stock_status === 'in_stock')
        <div class="p-4 pt-0">
            <button wire:click="addToCart" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                Add to Cart
            </button>
        </div>
    @else
        <div class="p-4 pt-0">
            <button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed font-medium">
                Out of Stock
            </button>
        </div>
    @endif
</div>
