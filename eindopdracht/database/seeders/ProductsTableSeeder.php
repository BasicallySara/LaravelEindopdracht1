<?php

namespace Database\Seeders;

use App\Models\Product; // Zorg ervoor dat je het juiste model importeert
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::create([
            'name' => 'Iphone 15', 
            'sku' => 'SKU-3832',
            'price' => 900.00,
            'description' => 'Latest iPhone with advanced features.',
            'image' => 'iphone15.jpg',
            'published_at' => now(), 
        ]);

        Product::create([
            'name' => 'PC parts', 
            'sku' => 'SKU-8273',
            'price' => 1600.00,
            'description' => 'High performance PC parts for gaming.',
            'image' => 'pc_parts.jpg',
            'published_at' => null, 
        ]);

        Product::create([
            'name' => 'Stanley cup!', 
            'sku' => 'SKU-39483',
            'price' => 51.00,
            'description' => 'Durable Stanley cup for drinks.',
            'image' => 'stanley_cup.jpg',
            'published_at' => now(),
        ]);

        Product::create([
            'name' => 'Set up', 
            'sku' => 'SKU-23678',
            'price' => 2000.00,
            'description' => 'Complete setup for gaming or work.',
            'image' => 'setup.jpg',
            'published_at' => null,
        ]);
    }
}
