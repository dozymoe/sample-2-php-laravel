<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get products.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'pivot_product_category',
            'category_id', 'product_id');
    }
}
