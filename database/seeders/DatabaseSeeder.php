<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Appelle le CategorySeeder
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            DemoOptionsSeeder::class,
        ]);

        
    }
}
