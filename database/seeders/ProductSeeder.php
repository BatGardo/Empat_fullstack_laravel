<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(15)
            ->create()
            ->each(function ($product) {
                // Додаємо 2-4 тегів до кожного товару
                $tags = Tag::inRandomOrder()->limit(rand(2, 4))->pluck('id');
                $product->tags()->attach($tags);
            });
    }
}
