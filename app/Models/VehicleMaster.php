<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleMaster extends Model
{
    use HasFactory;

    protected $table = 'vehicle_master';

    protected $fillable = [
        'costumer_id',
        'brand',
        'model',
        'year',
        'type',
        'wheels',
        'license_plate',
        'vin',
        'engine_number',
        'color',
        'purchase_year',
        'notes'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
