<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'description',
        'image_path',
        'image_alt',
        'image_mimetype',
        'updated_at',
    ];

    /**
     * Get categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class,
            'pivot_product_category', 'product_id', 'category_id');
    }
}
