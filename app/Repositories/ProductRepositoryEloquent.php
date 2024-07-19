<?php

namespace App\Repositories;

use App\Contracts\ProductRepository;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductRepositoryEloquent implements ProductRepository
{
    public function findAll(array $filterBy)
    {
        $query = Product::query();

        if (! empty($filterBy['search'])) {
            $query->where('name', 'like', $filterBy['search'] . '%');
        }

        if (! empty($filterBy['category'])) {
            $categoryCode = $filterBy['category'];
            $query->whereHas('categories', function ($q) use ($categoryCode) {
                $q->where('code', $categoryCode);
            });
        }

        if (! empty($filterBy['min_price'])) {
            $query->where('price', '>=', $filterBy['min_price']);
        }
        if (! empty($filterBy['max_price'])) {
            $query->where('price', '<=', $filterBy['max_price']);
        }

        return $query->orderBy('name')->get();
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
