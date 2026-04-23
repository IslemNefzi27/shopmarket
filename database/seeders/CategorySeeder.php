<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Électronique',        'description' => 'Smartphones, ordinateurs, accessoires tech'],
            ['name' => 'Mode & Vêtements',    'description' => 'Vêtements, chaussures, accessoires de mode'],
            ['name' => 'Maison & Déco',       'description' => 'Mobilier, décoration, articles ménagers'],
            ['name' => 'Sport & Loisirs',     'description' => 'Équipements sportifs, jeux, activités de plein air'],
            ['name' => 'Beauté & Santé',      'description' => 'Cosmétiques, soins, compléments alimentaires'],
            ['name' => 'Alimentation',        'description' => 'Épicerie fine, produits frais, boissons'],
            ['name' => 'Livres & Culture',    'description' => 'Livres, musique, films, jeux vidéo'],
            ['name' => 'Automobile',          'description' => 'Pièces auto, accessoires, entretien'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }
    }
}
