<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraEquipment extends Model
{
    protected $table = 'extra_equipment';

    protected $fillable = [
        'name',
        'description',
        'price_per_day',
    ];

    public function rentals()
    {
        return $this->belongsToMany(Rental::class, 'equipment_rental');
    }

}
