<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        $roleAdmin = Role::query()->create(['name' => 'admin']);
        $roleSeller = Role::query()->create(['name' => 'seller']);

        $permViewProduct = Permission::query()->create(['name' => 'view products']);
        $permEditProduct = Permission::query()->create(['name' => 'edit products']);

        $roleAdmin->syncPermissions([$permViewProduct, $permEditProduct]);
        $roleSeller->syncPermissions([$permViewProduct, $permEditProduct]);
    }

    public function down(): void
    {
        Role::query()->where('name', 'admin')->delete();
        Role::query()->where('name', 'seller')->delete();

        Permission::query()->where('name', 'view products')->delete();
        Permission::query()->where('name', 'edit products')->delete();
    }
};
