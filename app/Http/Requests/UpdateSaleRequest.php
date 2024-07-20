<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('object'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'nullable|int|min:1',
            'product_id' => 'nullable|exists:products,id',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'buyer_id' => 'nullable|exists:users,id',
            'seller_id' => 'nullable|exists:users,id',
            'product_name' => 'nullable|max:250',
            'product_stock' => 'nullable|int|min:0',
            'product_price' => 'nullable|decimal:0,2|min:0',
            'category_name' => 'nullable|max:250',
            'buyer_name' => 'nullable|max:255',
            'seller_name' => 'nullable|max:255',
            'created_at' => 'date',
            'updated_at' => 'date',
        ];
    }

    public function prepareForValidation()
    {
        $now = Carbon::now();

        $this->mergeIfMissing([
            'updated_at' => $now,
        ]);
    }
}
