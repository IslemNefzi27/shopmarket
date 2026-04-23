@extends('layouts.app')
@section('title', 'Mon profil')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Profile header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-8 text-white mb-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative flex flex-col sm:flex-row items-center gap-6">
            <div class="w-24 h-24 rounded-full border-4 border-white/50 overflow-hidden bg-indigo-400 flex items-center justify-center text-4xl font-bold">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div class="text-center sm:text-left">
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-white/80">{{ $user->email }}</p>
                @if($user->bio)
                    <p class="text-white/70 text-sm mt-2 max-w-md">{{ $user->bio }}</p>
                @endif
                <div class="flex items-center gap-4 mt-3 justify-center sm:justify-start">
                    <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
                        <i class="fas fa-box mr-1"></i> {{ $user->products->count() }} produits
                    </span>
                    <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
                        <i class="fas fa-receipt mr-1"></i> {{ $user->orders->count() }} commandes
                    </span>
                    <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
                        <i class="fas fa-star mr-1"></i> {{ $user->reviews->count() }} avis
                    </span>
                </div>
            </div>
            <div class="ml-auto hidden sm:block">
                <a href="{{ route('profile.edit') }}"
                    class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
                    <i class="fas fa-edit"></i> Modifier le profil
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Informations personnelles --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-gray-800">Informations personnelles</h2>
                <a href="{{ route('profile.edit') }}" class="text-sm text-indigo-600 hover:underline sm:hidden">
                    <i class="fas fa-edit"></i> Modifier
                </a>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <i class="fas fa-user text-gray-400 w-5"></i>
                    <div>
                        <p class="text-xs text-gray-400">Nom</p>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                    <div>
                        <p class="text-xs text-gray-400">Email</p>
                        <p class="font-medium text-gray-800">{{ $user->email }}
                            @if($user->email_verified_at)
                                <span class="text-green-500 text-xs ml-1"><i class="fas fa-check-circle"></i> Vérifié</span>
                            @else
                                <span class="text-yellow-500 text-xs ml-1"><i class="fas fa-exclamation-circle"></i> Non vérifié</span>
                            @endif
                        </p>
                    </div>
                </div>
                @if($user->phone)
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone text-gray-400 w-5"></i>
                        <div>
                            <p class="text-xs text-gray-400">Téléphone</p>
                            <p class="font-medium text-gray-800">{{ $user->phone }}</p>
                        </div>
                    </div>
                @endif
                @if($user->address)
                    <div class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                        <div>
                            <p class="text-xs text-gray-400">Adresse</p>
                            <p class="font-medium text-gray-800">{{ $user->address }}</p>
                        </div>
                    </div>
                @endif
                <div class="flex items-center gap-3">
                    <i class="fas fa-calendar text-gray-400 w-5"></i>
                    <div>
                        <p class="text-xs text-gray-400">Membre depuis</p>
                        <p class="font-medium text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-gray-800 mb-4">Actions rapides</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('products.my') }}"
                    class="flex flex-col items-center p-4 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition text-center">
                    <i class="fas fa-box text-2xl text-indigo-600 mb-2"></i>
                    <span class="text-sm font-medium text-indigo-700">Mes produits</span>
                    <span class="text-xs text-indigo-400">{{ $user->products->count() }}</span>
                </a>
                <a href="{{ route('orders.index') }}"
                    class="flex flex-col items-center p-4 bg-green-50 rounded-xl hover:bg-green-100 transition text-center">
                    <i class="fas fa-receipt text-2xl text-green-600 mb-2"></i>
                    <span class="text-sm font-medium text-green-700">Commandes</span>
                    <span class="text-xs text-green-400">{{ $user->orders->count() }}</span>
                </a>
                <a href="{{ route('wishlist.index') }}"
                    class="flex flex-col items-center p-4 bg-red-50 rounded-xl hover:bg-red-100 transition text-center">
                    <i class="fas fa-heart text-2xl text-red-500 mb-2"></i>
                    <span class="text-sm font-medium text-red-600">Wishlist</span>
                </a>
                <a href="{{ route('products.create') }}"
                    class="flex flex-col items-center p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition text-center">
                    <i class="fas fa-plus-circle text-2xl text-purple-600 mb-2"></i>
                    <span class="text-sm font-medium text-purple-700">Vendre</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
