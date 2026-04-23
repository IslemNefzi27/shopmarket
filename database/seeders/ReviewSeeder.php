<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::all();
        $products = Product::all();

        $comments = [
            5 => ['Excellent produit, je recommande vivement !', 'Parfait, conforme à la description.', 'Très satisfait de mon achat.'],
            4 => ['Bon produit dans l\'ensemble, livraison rapide.', 'Bien mais quelques petits défauts mineurs.', 'Rapport qualité/prix correct.'],
            3 => ['Produit correct sans plus, assez décevant.', 'Moyen, pas tout à fait ce que j\'attendais.', 'Qualité moyenne pour le prix.'],
            2 => ['Déçu par la qualité, ne correspond pas.', 'Quelques problèmes notés à la réception.', 'Pas terrible, je ne rachèterai pas.'],
        ];

        foreach ($products as $product) {
            $reviewers = $users->random(rand(2, 4));
            $reviewed  = [];

            foreach ($reviewers as $user) {
                if (in_array($user->id, $reviewed)) continue;
                $reviewed[] = $user->id;

                $rating = rand(2, 5);
                Review::create([
                    'user_id'    => $user->id,
                    'product_id' => $product->id,
                    'rating'     => $rating,
                    'comment'    => $comments[$rating][array_rand($comments[$rating])],
                ]);
            }
        }
    }
}
