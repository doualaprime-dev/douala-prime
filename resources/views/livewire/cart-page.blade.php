<div class="bg-gray-50 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex item-center gap-2">
                <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-yellow-500">Accueil</a></li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900 font-medium">Panier d'achat</li>
            </ol>
        </nav>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Panier d'achat</h1>

        @if (count($cart) > 0)
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Flash Messages -->
                    @if (session()->has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach ($cart as $cartKey => $item)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex gap-4">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100">
                                        @if ($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-700">
                                                <span class="text-2xl text-gray-500">
                                                    {{ substr($item['name'], 0, 30) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $item['name'] }}</h3>

                                    @if ($item['variant_name'])
                                        <p class="text-sm text-gray-600 mb-2">{{ $item['variant_name'] }}</p>
                                    @endif
                                    <p class="text-lg font-bold text-yellow-500">{{ number_format($item['price'], 3) }} F CFA</p>
                                </div>

                                <!-- Quantity & Actions -->
                                <div class="flex flex-col items-end justify-between">
                                    <button wire:click="removeItem('{{ $cartKey }}')" class="text-red-600 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    <div class="flex items-center gap-2">
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
                                        <button wire:click="updateQuantity('{{ $cartKey }}', {{ $item['quantity'] - 1 }})"
                                                class="w-8 h-8 rounded border border-gray-300 hover:bg-gray-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                        </button>

                                        <span class="w-12 text-center font-medium">{{ $item['quantity'] }}</span>

                                        <button wire:click="updateQuantity('{{ $cartKey }}', {{ $item['quantity'] + 1 }})"
                                                class="w-8 h-8 rounded border border-gray-300 hover:bg-gray-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="text-lg font-bold text-gray-900">
                                        {{ number_format($item['price'] * $item['quantity'], 3) }} F CFA
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Clear Cart -->
                    <div class="flex justify-between items-center pt-4">
                        <button wire:click="clearCart"
                                wire:confirm="Are you sure you want to clear the cart?"
                                class="text-red-600 hover:text-red-700 font-medium">
                            Vider le panier
                        </button>
                        <a href="{{ route('products.index') }}" class="text-yellow-500 hover:text-yellow-500 font-medium">
                            <- Continuer vos achats
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mt-8 lg:mt-8">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Résumé de la commande</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span>Sous-total ({{ count($cart) }} articles)</span>
                                <span>{{ number_format($this->subtotal, 3) }} F CFA</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Expédition</span>
                                <span class="font-medium">Calculé lors du paiement</span>
                            </div>
                        </div>

                        <div class="border-t pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">Total</span>
                                <span class="text-2xl font-bold text-yellow-500">
                                    {{ number_format($this->subtotal, 3) }} F CFA
                                </span>
                            </div>
                        </div>

                        @auth('customer')
                            <a href="{{ route('checkout') }}"
                                class="block w-full bg-yellow-500 text-white text-center py-3 px-6 rounded-lg hover:bg-yellow-600 transition font-semibold">
                                Passer à la caisse
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-yellow-500 text-white text-center py-3 px-6 rounded-lg hover:bg-yellow-600 transition font-semibold">
                                Connectez-vous pour finaliser votre commande.
                            </a>
                            <p class="text-sm text-gray-600 text-center mt-3">
                                Ou <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-600">Créer un compte</a>
                            </p>
                        @endauth

                        <!-- Trust Badges -->
                        <div class="mt-6 pt-6 border-t">
                            <div class="flex items-center gap-2">

                                <span>Paiement sécurisé</span>
                            </div>
                            <div class="flex items-center gap-2">

                                <span>Livraison gratuite</span>
                            </div>
                            <div class="flex items-center gap-2">

                                <span>Retours faciles</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-24 h-24 text-gray-400 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

                <h2 class="text-2xl font-bold text-gray-900 mb-2">Votre panier est vide.</h2>
                <p class="text-gray-600 mb-6">Ajoutez quelques produits pour commencer !</p>
                <a href="{{ route('products.index') }}"
                    class="inline-block bg-yellow-500 text-white px-8 py-3 rounded-lg hover:bg-yellow-600 transition font-semibold">
                    Commencez vos achats
                </a>
            </div>
        @endif
    </div>
</div>
