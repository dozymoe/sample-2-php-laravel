<?php

namespace App\Contracts;

use App\Models\ProductCategory;

interface ProductCategoryRepository
{
    public function findAll();

    public function findById(int $id);

    public function create(array $values);

    public function update(ProductCategory $object);

    public function destroy(ProductCategory $object);
}
