<?php

namespace App\Http\Controllers;

use App\Contracts\ProductCategoryRepository;
use App\Contracts\ProductRepository;
use App\Http\Requests\ListProductQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    protected ProductRepository $products;
    protected ProductCategoryRepository $categories;

    public function __construct(ProductRepository $productRepository,
        ProductCategoryRepository $categoryRepository)
    {
        $this->products = $productRepository;
        $this->categories = $categoryRepository;
    }

    public function index(ListProductQuery $request)
    {
        $query = $request->validated();
        $products = $this->products->findAll($query);

        return view(
            'welcome',
            [
                'products' => $products,
                'categories' => $this->categories->findAll([]),
            ]
        );
    }

    public function productImage(Request $request, string $filename)
    {
        $path = storage_path('app/' . $filename);

        if (! File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file)->header('Content-Type', $type);
    }
}
