<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    protected $fillable = [
        'name',
        'price',
        'status',
    ];

    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class, 'option_value_supplement');
    }
}
