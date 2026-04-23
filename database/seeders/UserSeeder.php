<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@shopmarket.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
            'bio'               => 'Administrateur de la plateforme ShopMarket.',
        ]);

        $users = [
            ['name' => 'Alice Martin',   'email' => 'alice@example.com'],
            ['name' => 'Bob Dupont',     'email' => 'bob@example.com'],
            ['name' => 'Claire Leblanc', 'email' => 'claire@example.com'],
            ['name' => 'David Moreau',   'email' => 'david@example.com'],
            ['name' => 'Emma Petit',     'email' => 'emma@example.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name'              => $u['name'],
                'email'             => $u['email'],
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
