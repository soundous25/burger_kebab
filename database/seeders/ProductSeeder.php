<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Burger Classic',
            'price' => 25,
            'description' => 'Burger avec viande, salade et sauce',
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Kebab Chicken',
            'price' => 30,
            'description' => 'Kebab au poulet grillé',
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Burger Cheese',
            'price' => 28,
            'description' => 'Burger avec fromage fondant',
            'category_id' => 1
        ]);
    }
}
