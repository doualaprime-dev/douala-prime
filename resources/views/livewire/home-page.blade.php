<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="-mx-4 flex flex-wrap">
            <div class="mb-8 w-full px-4 lg:mb-0 lg:w-3/4">
                <livewire:swiper-slider />
            </div>

            <div class="w-full px-4 lg:w-1/4">
                <div class="relative mb-4 overflow-hidden rounded-lg bg-white shadow-sm">
                    <div class="absolute top-0 right-0 rounded-bl-lg bg-red-500 px-3 py-1 text-white">-30%</div>
                    <img src="{{ asset('images/banner-5.png') }}" alt="Promo" class="h-52 w-full" />
                </div>
                <div class="relative overflow-hidden rounded-lg bg-white shadow-sm">
                    <img src="{{ asset('images/banner-6.png') }}" alt="Promo" class="h-52 w-full" />
                    <div class="absolute top-0 right-0 rounded-bl-lg bg-green-500 px-3 py-1 text-white">New</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                       class="group">
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-3">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-600">
                                    <span class="text-4xl text-white">{{ substr($category->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-center font-medium text-gray-900 group-hover:text-blue-600">
                            {{ $category->name }}
                        </h3>
                        <p class="text-center text-sm text-gray-500">{{ $category->products_count }} items</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <a href="{{ route('products.index', ['featured' => 1]) }}"
                   class="text-blue-600 hover:text-indigo-700 font-medium">
                    View All →
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($featuredProducts as $product)
                    <livewire:product-card :product="$product" :key="$product->id"  />
                @endforeach
            </div>
        </div>
    </section>

    <!-- New Arrivals -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">New Arrivals</h2>
                <a href="{{ route('products.index', ['sort' => 'newest']) }}"
                   class="text-blue-600 hover:text-indigo-700 font-medium">
                    View All →
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($newArrivals as $product)
                    <livewire:product-card :product="$product" :key="'new-' . $product->id"  />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 text-blue-600 rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Quality Guarantee</h3>
                    <p class="text-gray-600">All products are carefully selected and quality tested</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 text-blue-600 rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Shipping</h3>
                    <p class="text-gray-600">Quick delivery right to your doorstep</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 text-blue-600 rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
                    <p class="text-gray-600">Your payment information is safe with us</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Shop by Brand</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($brands as $brand)
                    <a href="{{ route('products.index', ['brand' => $brand->slug]) }}"
                       class="group">
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-3">
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}"
                                     alt="{{ $brand->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-600">
                                    <span class="text-4xl text-white">{{ substr($brand->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-center font-medium text-gray-900 group-hover:text-blue-600">
                            {{ $brand->name }}
                        </h3>
                        <p class="text-center text-sm text-gray-500">{{ $brand->products_count }} items</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

</div>
