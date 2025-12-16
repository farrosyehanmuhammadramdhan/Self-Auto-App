<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'vehicle_master_id',
        'technician_id',
    ];

    public function vehicleMaster() : BelongsTo
    {
        return $this->belongsTo(VehicleMaster::class, 'vehicle_master_id');
    }

    public function technician() : BelongsTo
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }
}
