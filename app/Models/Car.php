<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'price_per_day',
        'transmission',
        'fuel',
        'category',
        'featured',
        'image',
        'description',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}