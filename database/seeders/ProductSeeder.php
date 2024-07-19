<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seler user
        $userSellerId = DB::scalar('select id from users where email=?',
            ['seller@demo.com']);

        // Product categories
        $catKasurId = DB::scalar('select id from product_categories where code=?',
            ['kasur']);
        $catKursiId = DB::scalar('select id from product_categories where code=?',
            ['kursi']);
        $catGulingId = DB::scalar('select id from product_categories where code=?',
            ['guling']);

        // Image files
        $fs = new Filesystem;
        $imagePaths = [];
        Storage::put('public/kasur.jpg',
            $fs->get(dirname(__FILE__) . '/files/kasur.jpg'));
        $imagePaths[] = 'public/kasur.jpg';
        Storage::put('public/kursi.jpg',
            $fs->get(dirname(__FILE__) . '/files/kursi.jpg'));
        $imagePaths[] = 'public/kursi.jpg';
        Storage::put('public/guling.jpg',
            $fs->get(dirname(__FILE__) . '/files/guling.jpg'));
        $imagePaths[] = 'public/guling.jpg';

        $products = [];
        for ($ii = 1; $ii < 100; $ii++) {
            $newItem = [
                'code' => "product_{$ii}",
                'name' => implode(' ', fake()->words()),
                'description' => fake()->text(),
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => fake()->randomElement($imagePaths),
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ];

            $products[] = $newItem;
        }

        DB::table('products')->upsert($products, 'code');

        $productCategories = [];
        foreach (DB::select('select * from products') as $product) {
            $row = ['product_id' => $product->id];
            if (Str::contains($product->image_path, 'kasur')) {
                $row['category_id'] = $catKasurId;
            } elseif (Str::contains($product->image_path, 'kursi')) {
                $row['category_id'] = $catKursiId;
            } elseif (Str::contains($product->image_path, 'guling')) {
                $row['category_id'] = $catGulingId;
            }

            $productCategories[] = $row;
        }

        DB::table('pivot_product_category')->upsert($productCategories,
            ['product_id', 'category_id']);
    }
}
