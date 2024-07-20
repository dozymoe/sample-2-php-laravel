<?php

namespace App\Contracts;

use App\Models\Product;
use App\Models\ProductCategory;

interface ProductRepository
{
    public function findAll(array $query);

    public function findById(int $id);

    public function create(array $values);

    public function update(Product $object);

    public function destroy(Product $object);

    public function setCategory(Product $object, ?ProductCategory $category);
}
