<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMasters extends Model
{
    protected $fillable = [
        'costumers_id',
        'brand',
        'model',
        'model_year',
        'plate_number',
        'engine_number',
        'purchase_year',
        'type',
        'color',
    ];  
}
