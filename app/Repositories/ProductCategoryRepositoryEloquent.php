<?php

namespace App\Repositories;

use App\Contracts\ProductCategoryRepository;
use App\Models\ProductCategory;

class ProductCategoryRepositoryEloquent implements ProductCategoryRepository
{
    public function findAll()
    {
        $query = ProductCategory::query();

        return $query->orderBy('name')->get();
    }

    public function findById(int $id)
    {
        $query = ProductCategory::query();

        return $query->where('id', $id)->first();
    }

    public function create(array $values)
    {
        return ProductCategory::create($values);
    }

    public function update(ProductCategory $object)
    {
        $object->save();

        return $object;
    }

    public function destroy(ProductCategory $object)
    {
        $object->forceDelete();
    }
}
