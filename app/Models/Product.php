<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'name',
        'description',
        'price',
        'status',
        'category_id',
        'image',
    ];

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

     public function options()
    {
        return $this->belongsToMany(Option::class, 'product_option');
    }
}
