@extends('layouts.app')
@section('title', 'Nouveau mot de passe')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600"><i class="fas fa-store"></i> ShopMarket</a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Nouveau mot de passe</h2>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nouveau mot de passe</label>
                    <input type="password" name="password" required placeholder="Au moins 8 caractères"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                </div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Réinitialiser le mot de passe
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
