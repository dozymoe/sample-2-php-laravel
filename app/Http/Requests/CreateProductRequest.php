<?php

namespace App\Http\Requests;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|max:100|unique:products,code',
            'name' => 'required|max:250',
            'stock' => 'required|integer|min:0',
            'price' => 'required|decimal:0,2|min:0',
            'description' => 'nullable',
            'created_at' => 'date',
            'updated_at' => 'date',
            'image_path' => 'max:250',
            'image_alt' => 'nullable',
            'image_mimetype' => 'max:100',
            'category_id' => 'integer|exists:product_categories,id',
        ];
    }

    public function prepareForValidation()
    {
        $now = Carbon::now();

        $this->mergeIfMissing([
            'created_by' => $this->user()->id,
            'created_at' => $now,
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
