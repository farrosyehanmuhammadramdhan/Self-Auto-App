<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     * Menggunakan konvensi Laravel (bentuk jamak) untuk konsistensi.
     */
    protected $table = 'customers';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];

    
    public function vehicles() : HasMany
    {
        return $this->hasMany(VehicleMaster::class, 'customer_id');
    }

    public function services() {
        return $this->hasManyThrough(
            Service::class,
            VehicleMaster::class,
            'customer_id',
            'vehicle_master_id',
            'id',
            'id'
        );
    }
    /**
     * Atribut yang harus diubah ke tipe data tertentu (casts).
     * Contoh: Tidak ada yang diperlukan di sini, tetapi baik untuk diketahui.
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}