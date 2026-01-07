<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];


    /**
     * Scope: Only in-stock products.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope: Filter by category.
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
