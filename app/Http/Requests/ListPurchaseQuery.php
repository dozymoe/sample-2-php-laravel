<?php

namespace App\Http\Requests;

use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListPurchaseQuery extends FormRequest
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
            'search' => 'nullable',
            'category' => 'nullable|exists:product_categories,code',
            'min_date' => 'nullable|date',
            'max_date' => 'nullable|date',
            'sort' => [
                'nullable',
                Rule::in(['name', '-name', 'date', '-date']),
            ],
            'buyer_id' => 'int',
        ];
    }

    public function prepareForValidation()
    {
        if (! $this->user()->hasRole('admin')) {
            $this->merge([
                'buyer_id' => $this->user()->id,
            ]);
        }
    }
}
