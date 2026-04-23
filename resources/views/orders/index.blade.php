@extends('layouts.app')
@section('title', 'Mes commandes')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-receipt text-indigo-600 mr-2"></i> Mes Commandes
    </h1>

    @if($orders->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-receipt text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucune commande</h3>
            <p class="text-gray-400 mb-6">Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('products.index') }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Découvrir les produits
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="font-bold text-gray-800">Commande #{{ $order->id }}</span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order->status_badge['class'] }}">
                                    {{ $order->status_badge['label'] }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-400">
                                {{ $order->created_at->format('d/m/Y à H:i') }}
                                · {{ $order->items->count() }} article(s)
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="text-xl font-bold text-indigo-600">
                                {{ number_format($order->total_amount, 2, ',', ' ') }} TND
                            </span>
                            <a href="{{ route('orders.show', $order) }}"
                                class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
                                Voir le détail
                            </a>
                        </div>
                    </div>

                    {{-- Items preview --}}
                    <div class="px-5 pb-4 flex gap-2 overflow-x-auto">
                        @foreach($order->items->take(5) as $item)
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 overflow-hidden">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-box text-sm"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if($order->items->count() > 5)
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs font-semibold">
                                +{{ $order->items->count() - 5 }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
