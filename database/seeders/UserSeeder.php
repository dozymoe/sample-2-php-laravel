<?php

namespace Database\Seeders;

use Datetime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = new Datetime;
        $password = Hash::make('pass');

        $roleAdminId = DB::scalar('select id from roles where name=?', ['admin']);
        $roleSellerId = DB::scalar('select id from roles where name=?', ['seller']);

        DB::table('users')->upsert(
            [
                [
                    'email' => 'admin@demo.com',
                    'name' => 'Admin',
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'email' => 'seller@demo.com',
                    'name' => 'Seller',
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'email' => 'user@demo.com',
                    'name' => 'User',
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            'email');

        $userAdminId = DB::scalar('select id from users where email=?',
            ['admin@demo.com']);
        DB::table('model_has_roles')->upsert(
            [
                'model_type' => 'App\Models\User',
                'model_id' => $userAdminId,
                'role_id' => $roleAdminId,
            ],
            ['role_id', 'model_type', 'model_id']);

        $userSellerId = DB::scalar('select id from users where email=?',
            ['seller@demo.com']);
        DB::table('model_has_roles')->upsert(
            [
                'model_type' => 'App\Models\User',
                'model_id' => $userSellerId,
                'role_id' => $roleSellerId,
            ],
            ['role_id', 'model_type', 'model_id']);
    }
}
