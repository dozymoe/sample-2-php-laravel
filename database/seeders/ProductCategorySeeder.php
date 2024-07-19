<?php

namespace Database\Seeders;

use Datetime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = new Datetime;

        DB::table('product_categories')->upsert(
            [
                [
                    'code' => 'kasur',
                    'name' => 'Kasur',
                    'description' => 'Furnitur - kasur',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'kursi',
                    'name' => 'Kursi',
                    'description' => 'Furnitur - kursi',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'guling',
                    'name' => 'Guling',
                    'description' => 'Kamar tidur - guling',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            'code');
    }
}
