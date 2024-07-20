<?php

namespace App\Http\Requests;

use App\Contracts\ProductRepository;
use App\Contracts\UserRepository;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Sale::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|int|min:1',
            'product_id' => 'required|exists:products,id',
            'buyer_id' => 'required|exists:users,id',
            'created_at' => 'date',
            'updated_at' => 'date',
        ];
    }

    public function prepareForValidation()
    {
        $now = Carbon::now();

        $this->mergeIfMissing([
            'buyer_id' => $this->user()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function passedValidation()
    {
        $productRepository = app(ProductRepository::class);
        $userRepository = app(UserRepository::class);

        $product = $productRepository->findById($this->product_id);
        $buyer = $userRepository->findById($this->buyer_id);
        $productCategory = $product->categories->first();

        $this->merge([
            'product_category_id' => $productCategory->id,
            'seller_id' => $product->created_by,
            'product_name' => $product->name,
            'product_stock' => $product->stock,
            'product_price' => $product->price,
            'category_name' => $productCategory->name,
            'buyer_name' => $buyer->name,
            'seller_name' => $product->seller->name,
        ]);
    }
}
