@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">
                <i class="fas fa-store"></i> ShopMarket
            </a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Créer un compte</h2>
            <p class="text-gray-500 text-sm mt-1">Rejoignez notre marketplace</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Votre nom"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="vous@exemple.com"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="password" name="password" required
                            placeholder="Au moins 8 caractères"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="password" name="password_confirmation" required
                            placeholder="Confirmez votre mot de passe"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition mt-2">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Se connecter</a>
            </p>
        </div>
    </div>
</div>
@endsection
