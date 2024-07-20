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
                    'code' => 'consumption',
                    'name' => 'Konsumsi',
                    'description' => 'Persediaan konsumsi',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'cleaner',
                    'name' => 'Pembersih',
                    'description' => 'Persediaan pembersih',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            'code');
    }
}
