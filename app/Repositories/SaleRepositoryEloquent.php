<?php

namespace App\Repositories;

use App\Contracts\SaleRepository;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleRepositoryEloquent implements SaleRepository
{
    public function findAll(array $query)
    {
        $sql = Sale::query();

        if (! empty($query['buyer_id'])) {
            $sql->where('buyer_id', $query['buyer_id']);
        }

        if (! empty($query['category'])) {
            $categoryCode = $query['category'];
            $sql->whereHas('productCategory', function ($q) use ($categoryCode) {
                $q->where('code', $categoryCode);
            });
        }

        if (! empty($query['search'])) {
            $sql->where('product_name', 'like', $query['search'] . '%');
        }

        if (! empty($query['min_date'])) {
            $sql->where('created_at', '>=', $query['min_date']);
        }
        if (! empty($query['max_date'])) {
            $sql->where('created_at', '<=', $query['max_date']);
        }

        // sort by
        if (! empty($query['sort'])) {
            if ($query['sort'] === '-date') {
                $sql->orderBy('created_at', 'desc');
            } elseif ($query['sort'] === 'date') {
                $sql->orderBy('created_at');
            } elseif ($query['sort'] === '-name') {
                $sql->orderBy('product_name', 'desc');
            } else {
                $sql->orderBy('product_name');
            }
        } else {
            $sql->orderBy('product_name');
        }

        return $sql->get();
    }

    public function findById(int $id)
    {
        $query = Sale::query();

        return $query->where('id', $id)->first();
    }

    public function getStatistics(array $query)
    {
        $sql = Sale::query();

        // filter by seller
        if (! empty($query['seller_id'])) {
            $sql->where('seller_id', $query['seller_id']);
        }

        if (! empty($query['category'])) {
            $categoryCode = $query['category'];
            $sql->whereHas('productCategory', function ($q) use ($categoryCode) {
                $q->where('code', $categoryCode);
            });
        }

        // filter by date range maximum 90 days
        if (! empty($query['max_date'])) {
            $maxDate = Carbon::parse($query['max_date']);
            $sql->where('created_at', '<=', $maxDate);
        }
        if (! empty($query['min_date'])) {
            $minDate = Carbon::parse($query['min_date']);
            $sql->where('created_at', '>=', $minDate);
        }

        // sort by
        if (! empty($query['sort'])) {
            if ($query['sort'] === '-avgq') {
                $sql->orderBy('avg_quantity', 'desc');
            } elseif ($query['sort'] === 'avgq') {
                $sql->orderBy('avg_quantity');
            } elseif ($query['sort'] === '-maxq') {
                $sql->orderBy('max_quantity', 'desc');
            } elseif ($query['sort'] === 'maxq') {
                $sql->orderBy('max_quantity');
            } elseif ($query['sort'] === '-minq') {
                $sql->orderBy('min_quantity', 'desc');
            } elseif ($query['sort'] === 'minq') {
                $sql->orderBy('min_quantity');
            } elseif ($query['sort'] === '-sumq') {
                $sql->orderBy('sum_quantity', 'desc');
            } else {
                $sql->orderBy('sum_quantity');
            }
        } else {
            $sql->orderBy('sum_quantity');
        }

        return $sql
            ->select(
                DB::raw('ANY_VALUE(product_name) AS product_name'),
                DB::raw('ANY_VALUE(category_name) AS category_name'),
                DB::raw('SUM(quantity) AS sum_quantity'),
                DB::raw('AVG(quantity) AS avg_quantity'),
                DB::raw('MAX(quantity) AS max_quantity'),
                DB::raw('MIN(quantity) AS min_quantity'),
                DB::raw('COUNT(quantity) AS count_quantity'),
            )
            ->groupBy('product_id')
            ->get();
    }

    public function create(array $values)
    {
        return Sale::create($values);
    }

    public function update(Sale $object)
    {
        $object->save();

        return $object;
    }

    public function destroy(Sale $object)
    {
        $object->forceDelete();
    }
}
