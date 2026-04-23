@extends('layouts.app')
@section('title', 'Ma liste de souhaits')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-heart text-red-500 mr-2"></i> Ma liste de souhaits
    </h1>

    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-heart-broken text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Votre liste de souhaits est vide</h3>
            <p class="text-gray-400 mb-6">Ajoutez des produits que vous aimez pour les retrouver facilement.</p>
            <a href="{{ route('products.index') }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Explorer le catalogue
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                alt="{{ $product->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-image text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-indigo-500 font-medium">{{ $product->category->name }}</span>
                        <h3 class="font-semibold text-gray-800 mt-1 mb-2">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-600">
                                {{ $product->title }}
                            </a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">
                                {{ number_format($product->price, 2, ',', ' ') }} TND
                            </span>
                            <div class="flex gap-2">
                                @auth
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="text-xs bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-xs bg-red-100 text-red-500 px-3 py-1.5 rounded-lg hover:bg-red-200 transition">
                                            <i class="fas fa-heart-broken"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $products->links() }}</div>
    @endif
</div>
@endsection
