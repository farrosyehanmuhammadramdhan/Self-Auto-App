<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    protected $fillable = ['vehicle_master_id', 'technician_id', 'type', 'status', 'total_price', 'note'];

    public function vehicle() {
        return $this->belongsTo(VehicleMaster::class, 'vehicle_master_id');
    }

    public function technician() {
        return $this->belongsTo(Technician::class, 'technician_id');
    }

    public function items() {
        return $this->hasMany(ServiceItem::class);
    }

    public function spareparts() {
        return $this->hasMany(ServiceSparepartItem::class);
    }
}