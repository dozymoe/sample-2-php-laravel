<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('object'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'max:100|unique:products,code,' . $this->route('object')->id,
            'name' => 'max:250',
            'stock' => 'integer|min:0',
            'price' => 'decimal:0,2|min:0',
            'description' => 'nullable',
            'created_at' => 'date',
            'updated_at' => 'date',
            'image_path' => 'nullable|max:250',
            'image_alt' => 'nullable',
            'image_mimetype' => 'nullable|max:100',
            'category_id' => 'nullable|integer|exists:product_categories,id',
        ];
    }

    public function prepareForValidation()
    {
        $now = Carbon::now();

        $this->mergeIfMissing([
            'updated_at' => $now,
        ]);

        if (! empty($this->file('image'))) {
            $path = $this->file('image')->store('public');
            $this->mergeIfMissing([
                'image_path' => $path,
                'image_mimetype' => $this->file('image')->getClientMimeType(),
            ]);
        }
    }
}
