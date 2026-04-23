@extends('layouts.app')
@section('title', 'Passer la commande')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-credit-card text-indigo-600 mr-2"></i> Finaliser la commande
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Checkout form --}}
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Informations de livraison</h2>
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-4" id="checkoutForm">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse de livraison *</label>
                        <textarea name="shipping_address" rows="3" required
                            placeholder="Numéro, rue, ville, code postal, pays..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Notes (facultatif)</label>
                        <textarea name="notes" rows="2"
                            placeholder="Instructions spéciales de livraison..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none">{{ old('notes') }}</textarea>
                    </div>

                    <div class="bg-indigo-50 rounded-lg p-3 text-xs text-indigo-700">
                        <i class="fas fa-info-circle mr-1"></i>
                        En passant votre commande, vous acceptez nos conditions générales de vente.
                    </div>
                </form>
            </div>
        </div>

        {{-- Order summary --}}
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Récapitulatif</h2>

                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    @foreach($cartItems as $item)
                        <div class="flex items-center gap-3 py-2 border-b border-gray-50">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->title }}</p>
                                <p class="text-xs text-gray-400">Qté : {{ $item->quantity }}</p>
                            </div>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ number_format($item->subtotal, 2, ',', ' ') }} TND
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4 space-y-2 text-sm">
                    <div class="flex justify-between text-gray-500">
                        <span>Sous-total</span>
                        <span>{{ number_format($total, 2, ',', ' ') }} TND</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Livraison</span>
                        <span class="text-green-600">Gratuite</span>
                    </div>
                    <div class="flex justify-between text-gray-900 font-bold text-lg border-t pt-2">
                        <span>Total</span>
                        <span class="text-indigo-600">{{ number_format($total, 2, ',', ' ') }} TND</span>
                    </div>
                </div>

                <button type="submit" form="checkoutForm"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition mt-6 flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Confirmer la commande
                </button>

                <a href="{{ route('cart.index') }}"
                    class="block text-center text-sm text-gray-400 hover:text-gray-600 mt-3">
                    <i class="fas fa-arrow-left"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
