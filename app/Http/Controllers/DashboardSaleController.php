<?php

namespace App\Http\Controllers;

use App\Contracts\ProductCategoryRepository;
use App\Contracts\SaleRepository;
use App\Http\Requests\ListPurchaseQuery;
use App\Http\Requests\ListSaleQuery;

class DashboardSaleController extends Controller
{
    protected SaleRepository $sales;
    protected ProductCategoryRepository $categories;

    public function __construct(SaleRepository $saleRepository,
        ProductCategoryRepository $categoryRepository)
    {
        $this->sales = $saleRepository;
        $this->categories = $categoryRepository;
    }

    public function buyerIndex(ListPurchaseQuery $request)
    {
        $query = $request->validated();
        $sales = $this->sales->findAll($query);

        return view(
            'dashboard.purchase',
            [
                'objects' => $sales,
                'categories' => $this->categories->findAll([]),
            ]);
    }

    public function sellerIndex(ListSaleQuery $request)
    {
        $query = $request->validated();
        $sales = $this->sales->getStatistics($query);

        return view(
            'dashboard.sale',
            [
                'objects' => $sales,
                'categories' => $this->categories->findAll([]),
            ]);
    }
}
