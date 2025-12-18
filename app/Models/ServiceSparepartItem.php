<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSparepartItem extends Model
{
    use HasFactory;

    protected $table = 'services_spareparts_items';

    protected $fillable = [
        'service_id',
        'sparepart_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relasi ke header Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relasi ke Master Sparepart
     */
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }
    
    /**
     * Boot function untuk menghitung subtotal otomatis jika diperlukan
     * atau kamu bisa menghitungnya di Controller sebelum simpan.
     */
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->subtotal = $item->quantity * $item->price;
        });
    }
}