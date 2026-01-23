<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Connexion - {{ config('app.name') }}</title>

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
                        Bienvenu
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Vous n'avez pas de compte ?
                        <a href="{{ route('register') }}" class="font-medium text-yellow-500 hover:text-yellow-600">
                            S'inscrire
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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <input  type="checkbox"
                                        name="remember"
                                        class="w-4 h-4 text-yellow-500 border-yellow-300 rounded focus:ring-yellow-500"
                                        >
                                <span class="ml-2 text-sm text-gray-600">Souviens-toi de moi</span>
                            </label>

                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-yellow-500 hover:text-yellow-600">
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-yellow-500 text-white py-3 px-4 rounded-lg hover:bg-yellow-600 transition font-semibold">
                            Se Connecter
                        </button>
                    </form>

                    <!-- Social Login (Optional) -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-300">Ou continuez avec</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="{{ route('home') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span>Google</span>
                            </a>
                            <a href="{{ route('home') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span>Facebook</span>
                            </a>
                        </div>
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
