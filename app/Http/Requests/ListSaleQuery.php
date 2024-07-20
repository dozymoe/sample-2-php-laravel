<?php

namespace App\Http\Requests;

use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListSaleQuery extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('viewAny', Sale::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'nullable|exists:product_categories,code',
            'min_date' => 'nullable|date',
            'max_date' => 'nullable|date',
            'sort' => [
                'nullable',
                Rule::in(['sumq', '-sumq', 'avgq', '-avgq', 'maxq', '-maxq',
                    'minq', '-minq']),
            ],
            'seller_id' => 'int',
        ];
    }

    public function prepareForValidation()
    {
        if (! $this->user()->hasRole('admin')) {
            $this->merge([
                'seller_id' => $this->user()->id,
            ]);
        }
    }
}
