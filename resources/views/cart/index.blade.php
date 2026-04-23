@extends('layouts.app')
@section('title', 'Panier')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-shopping-cart text-indigo-600 mr-2"></i> Mon Panier
        @if($cartItems->isNotEmpty())
            <span class="text-sm font-normal text-gray-400">({{ $cartItems->sum('quantity') }} article(s))</span>
        @endif
    </h1>

    @if($cartItems->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-shopping-cart text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Votre panier est vide</h3>
            <p class="text-gray-400 mb-6">Découvrez nos produits et commencez vos achats.</p>
            <a href="{{ route('products.index') }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Parcourir le catalogue
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-xl shadow-sm p-4 flex items-center gap-4">
                        {{-- Image --}}
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    class="w-full h-full object-cover" alt="{{ $item->product->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('products.show', $item->product) }}"
                                class="font-semibold text-gray-800 hover:text-indigo-600 block truncate">
                                {{ $item->product->title }}
                            </a>
                            <p class="text-sm text-gray-400">{{ $item->product->category->name }}</p>
                            <p class="text-indigo-600 font-bold mt-1">{{ number_format($item->product->price, 2, ',', ' ') }} TND</p>
                        </div>

                        {{-- Quantity --}}
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-1">
                                @csrf @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                    min="1" max="{{ $item->product->stock }}"
                                    class="w-16 border border-gray-300 rounded-lg px-2 py-1.5 text-sm text-center focus:outline-none focus:border-indigo-500"
                                    onchange="this.form.submit()">
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <div class="text-right">
                            <p class="font-bold text-gray-900">{{ number_format($item->subtotal, 2, ',', ' ') }} TND</p>
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:text-red-600">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- Clear cart --}}
                <div class="flex justify-between items-center pt-2">
                    <form action="{{ route('cart.clear') }}" method="POST"
                        onsubmit="return confirm('Vider le panier ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm text-red-400 hover:text-red-600">
                            <i class="fas fa-trash"></i> Vider le panier
                        </button>
                    </form>
                    <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">
                        <i class="fas fa-arrow-left"></i> Continuer les achats
                    </a>
                </div>
            </div>

            {{-- Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Résumé</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total</span>
                            <span>{{ number_format($total, 2, ',', ' ') }} TND</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Livraison</span>
                            <span class="text-green-600 font-medium">Gratuite</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between font-bold text-gray-900 text-lg">
                            <span>Total</span>
                            <span class="text-indigo-600">{{ number_format($total, 2, ',', ' ') }} TND</span>
                        </div>
                    </div>

                    <a href="{{ route('orders.checkout') }}"
                        class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition mt-6">
                        Commander maintenant <i class="fas fa-arrow-right ml-1"></i>
                    </a>

                    <div class="mt-4 flex items-center justify-center gap-4 text-xs text-gray-400">
                        <span><i class="fas fa-lock text-green-500 mr-1"></i> Paiement sécurisé</span>
                        <span><i class="fas fa-truck text-green-500 mr-1"></i> Livraison offerte</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
