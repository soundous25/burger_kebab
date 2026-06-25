<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Burgers',
            'order' => 1,
            'status' => true,
        ]);

        Category::create([
            'name' => 'Kebabs',
            'order' => 2,
            'status' => true,
        ]);

        Category::create([
            'name' => 'Menus',
            'order' => 3,
            'status' => true,
        ]);

        Category::create([
            'name' => 'Boissons',
            'order' => 4,
            'status' => true,
        ]);

        Category::create([
            'name' => 'Desserts',
            'order' => 5,
            'status' => true,
        ]);
    }
}
