<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        $uSellerId = DB::scalar('select id from users where email=?',
            ['seller@demo.com']);
        $uId = DB::scalar('select id from users where email=?',
            ['user@demo.com']);

        // Product categories
        $catConsumptionId = DB::scalar(
            'select id from product_categories where code=?',
            ['consumption']);
        $catCleanerId = DB::scalar('select id from product_categories where code=?',
            ['cleaner']);

        // Products
        $pCoffeeId = DB::scalar('select id from products where code=?',
            ['coffee']);
        $pTeaId = DB::scalar('select id from products where code=?',
            ['tea']);
        $pToothpasteId = DB::scalar('select id from products where code=?',
            ['toothpaste']);
        $pSoapId = DB::scalar('select id from products where code=?',
            ['soap']);
        $pShampooId = DB::scalar('select id from products where code=?',
            ['shampoo']);

        $sales = [
            [
                'quantity' => 10,
                'product_id' => $pCoffeeId,
                'product_category_id' => $catConsumptionId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Kopi',
                'product_stock' => 100,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Konsumsi',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-01'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 19,
                'product_id' => $pTeaId,
                'product_category_id' => $catConsumptionId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Teh',
                'product_stock' => 100,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Konsumsi',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-05'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 15,
                'product_id' => $pCoffeeId,
                'product_category_id' => $catConsumptionId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Kopi',
                'product_stock' => 90,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Konsumsi',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-10'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 20,
                'product_id' => $pToothpasteId,
                'product_category_id' => $catCleanerId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Pasta Gigi',
                'product_stock' => 100,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Pembersih',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-11'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 30,
                'product_id' => $pSoapId,
                'product_category_id' => $catCleanerId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Sabun Mandi',
                'product_stock' => 100,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Pembersih',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-11'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 25,
                'product_id' => $pShampooId,
                'product_category_id' => $catCleanerId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Sampo',
                'product_stock' => 100,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Pembersih',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-12'),
                'updated_at' => fake()->dateTime(),
            ],
            [
                'quantity' => 5,
                'product_id' => $pTeaId,
                'product_category_id' => $catConsumptionId,
                'buyer_id' => $uId,
                'seller_id' => $uSellerId,
                'product_name' => 'Teh',
                'product_stock' => 81,
                'product_price' => fake()->randomFloat(2, 1, 99999),
                'category_name' => 'Konsumsi',
                'buyer_name' => 'User',
                'seller_name' => 'Seller',
                'created_at' => Carbon::parse('2021-05-12'),
                'updated_at' => fake()->dateTime(),
            ],
        ];
        DB::table('sales')->insert($sales);
    }
}
