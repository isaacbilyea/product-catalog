<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'MacBook Pro',
            'description' => 'High-performance laptop for professionals',
            'price' => 2499.99,
            'category' => 'Electronics'
        ]);

        Product::create([
            'name' => 'Wireless Mouse',
            'description' => 'Ergonomic wireless mouse',
            'price' => 79.99,
            'category' => 'Accessories'
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB mechanical gaming keyboard',
            'price' => 149.99,
            'category' => 'Accessories'
        ]);
    }
}