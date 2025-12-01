<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMasters extends Model
{
    use HasFactory;

    protected $fillable = [
        'costumers_id',
        'brand',
        'model',
        'model_year',
        'plate_number',
        'engine_number',
        'purchase_year',
        'wheel',
        'type',
        'color',
    ];  


    public function costumers()
    {
        return $this->belongsTo(Costumers::class);
    }
}
