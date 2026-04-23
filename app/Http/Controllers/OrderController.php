<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items.product.category', 'user');
        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = $cartItems->sum('subtotal');

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => ['required', 'string', 'max:500'],
            'notes'            => ['nullable', 'string', 'max:1000'],
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        DB::transaction(function () use ($request, $cartItems) {
            $total = $cartItems->sum('subtotal');

            $order = Order::create([
                'user_id'          => Auth::id(),
                'status'           => Order::STATUS_PENDING,
                'total_amount'     => $total,
                'shipping_address' => $request->shipping_address,
                'notes'            => $request->notes,
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity'   => $cartItem->quantity,
                    'unit_price' => $cartItem->product->price,
                ]);
            }

            CartItem::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'Commande passée avec succès !');
    }

    public function cancel(Order $order)
    {
        $this->authorize('update', $order);

        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Seules les commandes en attente peuvent être annulées.');
        }

        $order->update(['status' => Order::STATUS_CANCELLED]);

        return back()->with('success', 'Commande annulée.');
    }
}
