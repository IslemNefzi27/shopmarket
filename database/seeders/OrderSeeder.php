<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::all();
        $products = Product::all();
        $statuses = ['pending', 'validated', 'cancelled', 'shipped', 'delivered'];

        for ($i = 0; $i < 10; $i++) {
            $user     = $users->random();
            $numItems = rand(1, 3);
            $selected = $products->random($numItems);
            $total    = 0;

            $order = Order::create([
                'user_id'          => $user->id,
                'status'           => $statuses[array_rand($statuses)],
                'total_amount'     => 0,
                'shipping_address' => $user->address ?? '123 rue Exemple, 75001 Paris, France',
                'notes'            => rand(0, 1) ? 'Livraison express souhaitée.' : null,
            ]);

            foreach ($selected as $product) {
                $qty = rand(1, 3);
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'unit_price' => $product->price,
                ]);
                $total += $qty * $product->price;
            }

            $order->update(['total_amount' => $total]);
        }
    }
}
