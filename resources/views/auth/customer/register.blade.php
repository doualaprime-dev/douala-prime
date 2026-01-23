<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inscription - {{ config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-yellow-500">
                        {{ config('app.name') }}
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">
                        Créez votre compte
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="font-medium text-yellow-500 hover:text-yellow-600">
                            Se Connecter
                        </a>
                    </p>
                </div>

                <!-- Login Form -->
                <div class="bg-white py-8 px-6 shadow-lg rounded-lg">
                    @if (session('status'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom et prénom
                            </label>
                            <input  id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse Email
                            </label>
                            <input  id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro de Téléphone (Facultatif)
                            </label>
                            <input  id="phone"
                                    type="tel"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    autofocus
                                    class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    >
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Mot de passe
                            </label>
                            <input  id="password"
                                    type="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    required
                                    class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirmez votre mot de passe
                            </label>
                            <input  id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    required
                                    class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    >
                        </div>

                        <!-- Terms -->
                        <div class="mb-6">
                            <label class="flex items-start">
                                <input  type="checkbox"
                                        required
                                        class="w-4 h-4 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500"
                                    >
                                <span class="ml-2 text-sm text-gray-600">
                                    J'accepte
                                    <a href="#" class="text-yellow-500 hover:text-yellow-600">Les conditions générales</a>
                                    et
                                    <a href="#" class="text-yellow-500 hover:text-yellow-600">La politique de confidentialité</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-yellow-500 text-white py-3 px-4 rounded-lg hover:bg-yellow-600 transition font-semibold">
                            Créer un compte
                        </button>
                    </form>

                    <!-- Benefits -->
                    <div class="mt-6 p-4 rounded-lg bg-green-100">
                        <p class="text-sm font-medium text-green-900 mb-2">Pourquoi nous rejoindre ?</p>
                        <ul class="text-sm text-green-700 space-y-1">
                            <li>✔️ Suivez facilement vos commandes</li>
                            <li>✔️ Enregistrer plusieurs adresses</li>
                            <li>✔️ Bénéficiez d'offres exclusives réservées aux membres</li>
                            <li>✔️ Processus de paiement plus rapide</li>
                        </ul>
                    </div>
                </div>

                <!-- Back to Home -->
                <p class="mt-6 text-center text-sm text-gray-600">
                    <a href="{{ route('home') }}" class="font-medium text-yellow-500 hover:text-yellow-600">
                        <- Retour à l'accueil
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>
