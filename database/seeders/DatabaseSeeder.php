<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User utama
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
            ]
        );

        // Pastikan ada beberapa kategori
        if (Category::count() < 5) {
            Category::factory(5 - Category::count())->create();
        }

        // Pastikan ada beberapa tag
        if (Tag::count() < 10) {
            Tag::factory(10 - Tag::count())->create();
        }

        // Buat produk sampai jumlah minimal 50
        $jumlahProduk = Product::count();

        if ($jumlahProduk < 50) {
            Product::factory(50 - $jumlahProduk)->create();
        }

        // Hubungkan setiap produk dengan 1-3 tag
        $tags = Tag::all();

        Product::with('tags')->get()->each(function ($product) use ($tags) {
            if ($product->tags->isEmpty()) {
                $product->tags()->attach(
                    $tags->random(rand(1, min(3, $tags->count())))->pluck('id')->toArray()
                );
            }
        });
    }
}