<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (opsional jika nama file sudah sesuai standar Laravel)
    protected $table = 'services_items';

    protected $fillable = [
        'service_id',
        'service_master_id',
        'price',
    ];

    /**
     * Relasi ke header Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Relasi ke Master Jasa (Ganti Oli, Service Ringan, dll)
     */
    public function serviceMaster()
    {
        return $this->belongsTo(ServiceMaster::class, 'service_master_id');
    }
}