@extends('layouts.app')
@section('title', 'Mot de passe oublié')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600"><i class="fas fa-store"></i> ShopMarket</a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Réinitialiser le mot de passe</h2>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-4 text-sm">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="vous@exemple.com"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Envoyer le lien de réinitialisation
                </button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                    <i class="fas fa-arrow-left"></i> Retour à la connexion
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
