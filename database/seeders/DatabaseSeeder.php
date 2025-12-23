<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@secureshop.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin', //
        ]);

        // 2. Create Normal User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 3. Create Sample Products
        Product::create([
            'name' => 'Secure Laptop Pro',
            'description' => 'High-performance laptop with built-in encryption features.',
            'price' => 4500.00,
            'category' => 'Electronics',
            'stock' => 15,
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB backlit keyboard with blue switches.',
            'price' => 250.00,
            'category' => 'Accessories',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Noise Cancelling Headphones',
            'description' => 'Premium wireless headphones for deep focus.',
            'price' => 899.00,
            'category' => 'Electronics',
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Ergonomic Desk Chair',
            'description' => 'Fully adjustable chair designed for long working hours.',
            'price' => 1200.50,
            'category' => 'Furniture',
            'stock' => 10,
        ]);
    }
}