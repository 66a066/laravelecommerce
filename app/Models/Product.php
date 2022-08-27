<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'product_image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_descrip',
        'meta_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
