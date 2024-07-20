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
        $permCreateProduct = Permission::query()->create(
            ['name' => 'create products']);
        $permEditProduct = Permission::query()->create(['name' => 'edit products']);

        $permViewSale = Permission::query()->create(['name' => 'view sales']);
        $permCreateSale = Permission::query()->create(['name' => 'create sales']);
        $permEditSale = Permission::query()->create(['name' => 'edit sales']);

        $roleAdmin->syncPermissions([
            $permViewProduct, $permCreateProduct, $permEditProduct,
            $permViewSale, $permCreateSale, $permEditSale]);
        $roleSeller->syncPermissions([
            $permViewProduct, $permCreateProduct, $permEditProduct,
            $permViewSale]);
    }

    public function down(): void
    {
        Role::query()->where('name', 'admin')->delete();
        Role::query()->where('name', 'seller')->delete();

        Permission::query()->where('name', 'view products')->delete();
        Permission::query()->where('name', 'create products')->delete();
        Permission::query()->where('name', 'edit products')->delete();

        Permission::query()->where('name', 'view sales')->delete();
        Permission::query()->where('name', 'create sales')->delete();
        Permission::query()->where('name', 'edit sales')->delete();
    }
};
