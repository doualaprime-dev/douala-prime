<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'E-Commerce Store') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
        <style>
            [x-cloak] {
                display: none !important;
            }
            .container {
                width: 100%;
                margin: auto;
            }
            .swiper {
                width: 100%;
            }
            .swiper-slide {
                text-align: center;
                background: #eee;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 18px;
            }
        </style>

        @filamentStyles
    </head>
    <body class="bg-gray-50 antialiased">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Top Bar -->
                <div class="flex flex-wrap items-center justify-between py-2 space-y-2">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-yellow-500">
                            <img src="{{ asset('images/logo.png') }}" alt="Promo" class="w-25 h-15" />
                        </a>
                    </div>

                    <!-- Search Bar (Desktop) -->
                    <div class=" flex-1 mx-8 lg:block">
                        <livewire:search-bar />
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-4">
                        @auth('customer')
                            <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-yellow-500">
                                Se Connecter
                            </a>
                        @endauth

                        <!-- Cart -->
                        <livewire:cart-icon />
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="border-t py-3">
                    <ul class="flex flex-wrap items-center gap-8">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-yellow-500 font-medium">
                                Accueil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-yellow-500 font-medium">
                                Boutique
                            </a>
                        </li>

                        @foreach (\App\Models\Category::active()->sorted()->limit(6)->get() as $category)
                            <li class="hidden lg:block">
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-gray-700 hover:text-yellow-500 font-medium">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>
        @livewire('notifications')

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4"><a href="{{ route('home') }}" class="text-2xl font-bold text-yellow-500">
                            <img src="{{ asset('images/logo.png') }}" alt="Promo" class="w-25 h-15" />
                        </a></h3>
                        <p class="text-gray-400">Douala-Prime propose une vaste gamme de produits de haute qualité à des prix compétitifs. Nous nous engageons à vous offrir une expérience d'achat exceptionnelle,
                            avec une livraison rapide et un excellent service client..</p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Liens rapides</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white">Boutique</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">A Propos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Service clientèle</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white">Informations sur la livraison</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Retours</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Historique des commandes</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Liste de souhaits</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Conditions générales</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQs</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Mon Compte</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('customer.dashboard') }}" class="text-gray-400 hover:text-white">Tableau de bord</a></li>
                            <li><a href="{{ route('customer.orders') }}" class="text-gray-400 hover:text-white">Commandes</a></li>
                            <li><a href="{{ route('customer.profile') }}" class="text-gray-400 hover:text-white">Profil</a></li>
                            <li><span className="text-gray-400">
                                    Deido Grand Moulin
                                    <br />
                                    MRS Omnisports
                                </span></li>
                            <li><span className="text-gray-400">
                                    +237 670 85 72 04
                                    <br />
                                    +237 699 01 35 35
                                </span></li>
                            <li><span className="text-gray-400">doualaprime@commande.com</span></li>
                            <li><span className="text-gray-400">Lundi - Samedi : 8H - 18H</span></li>
                            <li></li>
                        </ul>
                    </div>
                </div>

                <hr class="my-8 border-gray-700" />

                <div class="flex flex-col items-center justify-between md:flex-row">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
                    <div class="flex space-x-6">
                        <img src="/images/payment-4.png" alt="Payment" class="h-8" />
                        <img src="/images/payment-3.png" alt="Payment" class="h-8" />
                        <img src="/images/payment-2.png" alt="Payment" class="h-8" />
                        <img src="/images/payment-1.png" alt="Payment" class="h-8" />
                    </div>
                </div>
            </div>
        </footer>

        @livewireScripts
        @filamentScripts

        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    </body>
</html>
