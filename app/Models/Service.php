<?php

namespace App\Models;

use App\Http\Controllers\TechniciansController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'technician_id',
        'service_date',
        'service_type',
        'mileage',
        'description',
        'cost',
        'payment_status',
        'status',
    ];

    protected $casts = [
        'service_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function vehicle()
    {
        return $this->belongsTo(VehicleMaster::class);
    }

    public function technician()
    {
        return $this->belongsTo(TechniciansController::class, 'technician_id');
    }
}
