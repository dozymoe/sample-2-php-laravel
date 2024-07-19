<?php

namespace App\Http\Controllers;

use App\Contracts\ProductCategoryRepository;
use App\Contracts\ProductRepository;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminProductController extends Controller
{
    protected ProductRepository $products;
    protected ProductCategoryRepository $categories;

    public function __construct(ProductRepository $productRepository,
        ProductCategoryRepository $categoryRepository)
    {
        $this->products = $productRepository;
        $this->categories = $categoryRepository;
    }

    public function createForm(Request $request)
    {
        Gate::authorize('create', Product::class);

        return view(
            'product.edit',
            [
                'object' => new Product,
                'categories' => $this->categories->findAll(),
            ]
        );
    }

    public function doCreate(CreateProductRequest $request)
    {
        $values = $request->validated();
        $object = $this->products->create($values);
        if (! empty($values['category_id'])) {
            $category = $this->categories->findById($values['category_id']);
            $this->products->setCategory($object, $category);
        } else {
            $this->products->setCategory($object, null);
        }

        return redirect($request->query('next') ?? route('home'));
    }

    public function updateForm(Request $request, Product $object)
    {
        Gate::authorize('update', $object);

        return view(
            'product.edit',
            [
                'object' => $object,
                'categories' => $this->categories->findAll(),
            ]
        );
    }

    public function doUpdate(UpdateProductRequest $request, Product $object)
    {
        $values = $request->validated();
        $object->fill($values);
        $this->products->update($object);
        if (! empty($values['category_id'])) {
            $category = $this->categories->findById($values['category_id']);
            $this->products->setCategory($object, $category);
        } else {
            $this->products->setCategory($object, null);
        }

        return redirect($request->query('next') ?? route('home'));
    }

    public function deleteForm(Request $request, Product $object)
    {
        Gate::authorize('delete', $object);

        return view('product.delete', ['object' => $object]);
    }

    public function doDelete(Request $request, Product $object)
    {
        Gate::authorize('delete', $object);

        $this->products->destroy($object);

        return redirect($request->query('next') ?? route('home'));
    }
}
