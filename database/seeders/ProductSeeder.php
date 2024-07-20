<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $catConsumptionId = DB::scalar(
            'select id from product_categories where code=?',
            ['consumption']);
        $catCleanerId = DB::scalar('select id from product_categories where code=?',
            ['cleaner']);

        // Image files
        $fs = new Filesystem;
        foreach (['kopi', 'pasta_gigi', 'sabun_mandi', 'sampo', 'teh'] as $pic) {
            Storage::put('public/' . $pic . '.jpg',
                $fs->get(dirname(__FILE__) . '/files/' . $pic . '.jpg'));
        }

        $products = [
            [
                'code' => 'coffee',
                'name' => 'Kopi',
                'description' => 'Kopi',
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => 'public/kopi.jpg',
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'code' => 'tea',
                'name' => 'Teh',
                'description' => 'Teh',
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => 'public/teh.jpg',
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'code' => 'toothpaste',
                'name' => 'Pasta gigi',
                'description' => 'Pasta gigi',
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => 'public/pasta_gigi.jpg',
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'code' => 'soap',
                'name' => 'Sabun mandi',
                'description' => 'Sabun mandi',
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => 'public/sabun_mandi.jpg',
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'code' => 'shampoo',
                'name' => 'Sampo',
                'description' => 'Sampo',
                'stock' => fake()->randomNumber(5),
                'price' => fake()->randomFloat(2, 1, 99999),
                'image_path' => 'public/sampo.jpg',
                'image_alt' => fake()->text(),
                'image_mimetype' => 'image/jpeg',
                'created_by' => $userSellerId,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ],
        ];
        DB::table('products')->upsert($products, 'code');

        $productCategories = [];
        foreach (DB::select('select * from products') as $product) {
            $row = ['product_id' => $product->id];
            if (in_array($product->code, ['coffee', 'tea'])) {
                $row['category_id'] = $catConsumptionId;
            } elseif (in_array($product->code, ['toothpaste', 'soap', 'shampoo'])) {
                $row['category_id'] = $catCleanerId;
            }

            $productCategories[] = $row;
        }

        DB::table('pivot_product_category')->upsert($productCategories,
            ['product_id', 'category_id']);
    }
}
