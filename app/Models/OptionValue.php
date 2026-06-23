<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = [
        'option_id',
        'name',
        'status',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function supplements()
    {
        return $this->belongsToMany(Supplement::class, 'option_value_supplement');
    }
}
