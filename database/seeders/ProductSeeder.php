<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $users      = User::all();
        $categories = Category::all()->keyBy('slug');

        $products = [
            // Électronique
            [
                'title'       => 'Smartphone Samsung Galaxy A54',
                'description' => 'Écran AMOLED 6.4", 128Go, 5G, triple caméra 50MP. Performance exceptionnelle au quotidien.',
                'price'       => 349.99,
                'stock'       => 25,
                'category'    => 'electronique',
            ],
            [
                'title'       => 'Casque Bluetooth Sony WH-1000XM5',
                'description' => 'Réduction de bruit premium, autonomie 30h, qualité audio Hi-Res. Le meilleur casque sans fil.',
                'price'       => 279.99,
                'stock'       => 15,
                'category'    => 'electronique',
            ],
            [
                'title'       => 'Tablette iPad Air 2024',
                'description' => 'Puce M2, écran Liquid Retina 11", compatible Apple Pencil. Idéal pour la créativité.',
                'price'       => 699.00,
                'stock'       => 10,
                'category'    => 'electronique',
            ],

            // Mode
            [
                'title'       => 'Veste en cuir artisanale',
                'description' => 'Veste en cuir véritable, coupe slim, fabriquée à la main en France. Style intemporel.',
                'price'       => 189.99,
                'stock'       => 8,
                'category'    => 'mode-vetements',
            ],
            [
                'title'       => 'Sneakers Running Adidas Ultraboost',
                'description' => 'Chaussures de course ultra-confortables, semelle Boost, mesh respirant. Pour tous les terrains.',
                'price'       => 159.99,
                'stock'       => 30,
                'category'    => 'mode-vetements',
            ],

            // Maison
            [
                'title'       => 'Lampe de bureau LED design',
                'description' => 'Lampe LED avec port USB, 5 niveaux de luminosité, design épuré. Parfaite pour le télétravail.',
                'price'       => 45.99,
                'stock'       => 40,
                'category'    => 'maison-deco',
            ],
            [
                'title'       => 'Canapé 3 places tissu gris',
                'description' => 'Canapé confortable en tissu gris anthracite, pieds en bois naturel, livraison incluse.',
                'price'       => 599.00,
                'stock'       => 5,
                'category'    => 'maison-deco',
            ],

            // Sport
            [
                'title'       => 'Vélo de route carbone Shimano 105',
                'description' => 'Cadre carbone ultraléger, groupe Shimano 105 22v, freins à disque. Le graal du cycliste.',
                'price'       => 1299.00,
                'stock'       => 3,
                'category'    => 'sport-loisirs',
            ],
            [
                'title'       => 'Tapis de yoga premium 6mm',
                'description' => 'Tapis antidérapant en caoutchouc naturel, épaisseur 6mm, sangle de transport incluse.',
                'price'       => 59.99,
                'stock'       => 50,
                'category'    => 'sport-loisirs',
            ],

            // Beauté
            [
                'title'       => 'Sérum visage à la vitamine C',
                'description' => 'Sérum concentré 20% vitamine C, anti-âge, éclat et fermeté. Résultats visibles en 4 semaines.',
                'price'       => 34.99,
                'stock'       => 60,
                'category'    => 'beaute-sante',
            ],

            // Alimentation
            [
                'title'       => 'Café arabica bio 500g',
                'description' => 'Café 100% arabica, torréfaction artisanale, origine Éthiopie. Notes de fruits et fleurs.',
                'price'       => 18.99,
                'stock'       => 100,
                'category'    => 'alimentation',
            ],

            // Livres
            [
                'title'       => 'Laravel — Du développement au déploiement',
                'description' => 'Guide complet pour maîtriser Laravel 11, avec projets pratiques et bonnes pratiques. 400 pages.',
                'price'       => 29.99,
                'stock'       => 20,
                'category'    => 'livres-culture',
            ],
        ];

        $userList = $users->shuffle()->values();

        foreach ($products as $i => $data) {
            $slug     = $data['category'];
            $category = $categories->get($slug);

            if (!$category) {
                continue;
            }

            Product::create([
                'title'       => $data['title'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
                'category_id' => $category->id,
                'user_id'     => $userList[$i % $userList->count()]->id,
                'is_active'   => true,
            ]);
        }
    }
}
