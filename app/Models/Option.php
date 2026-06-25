<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name',
        'is_required',
        'min_select',
        'max_select',
        'status',
    ];

    public function values()
    {
        return $this->hasMany(OptionValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'option_product');
    }
}
