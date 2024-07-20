<?php

namespace App\Repositories;

use App\Contracts\ProductRepository;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductRepositoryEloquent implements ProductRepository
{
    public function findAll(array $query)
    {
        $sql = Product::query();

        if (! empty($query['search'])) {
            $sql->where('name', 'like', $query['search'] . '%');
        }

        if (! empty($query['category'])) {
            $categoryCode = $query['category'];
            $sql->whereHas('categories', function ($q) use ($categoryCode) {
                $q->where('code', $categoryCode);
            });
        }

        if (! empty($query['min_price'])) {
            $sql->where('price', '>=', $query['min_price']);
        }
        if (! empty($query['max_price'])) {
            $sql->where('price', '<=', $query['max_price']);
        }

        return $sql->orderBy('name')->get();
    }

    public function findById(int $id)
    {
        $query = Product::query();

        return $query->where('id', $id)->first();
    }

    public function create(array $values)
    {
        return Product::create($values);
    }

    public function update(Product $object)
    {
        $object->save();

        return $object;
    }

    public function destroy(Product $object)
    {
        $object->forceDelete();
    }

    public function setCategory(Product $object, ?ProductCategory $category)
    {
        if (isset($category)) {
            DB::table('pivot_product_category')
                ->where('product_id', $object->id)
                ->where('category_id', '!=', $category->id)
                ->delete();
            DB::table('pivot_product_category')->upsert(
                [
                    'product_id' => $object->id,
                    'category_id' => $category->id,
                ],
                ['product_id', 'category_id']
            );
        } else {
            DB::table('pivot_product_category')
                ->where('product_id', $object->id)
                ->delete();
        }
    }
}
