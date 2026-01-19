<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleMaster extends Model
{
    use HasFactory;

    // Nama tabel disesuaikan dengan konvensi laravel (vehicle_masters), 
    // namun menggunakan nama yang kamu berikan di awal jika kamu tetap ingin menggunakan 'vehicle_master'
    // protected $table = 'vehicle_master'; 
    protected $table = 'vehicle_masters'; // Nama ini lebih sesuai dengan Laravel convention

    protected $fillable = [
        'customer_id', // Koreksi ke customer_id
        'brand',
        'model',
        'model_year', // Koreksi: Menggunakan model_year sesuai migrasi
        'type',
        'wheels',
        'license_plate',
        'color',
        'vin',
        'engine_number',
        'purchase_year',
        'note' // Koreksi ke 'note' sesuai migrasi
    ];

    /**
     * Relasi ke Customer.
     */
    public function customer()
    {
        // Pastikan nama Model Customer sudah benar (asumsi App\Models\Customer)
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi ke Service.
     */
    public function services()
    {
        // Pastikan nama Model Service sudah benar (asumsi App\Models\Service)
        return $this->hasMany(Service::class);
    }
    
    /**
     * Casting atribut untuk tipe data. Opsional, tapi bisa membantu.
     */
    protected $casts = [
        'model_year' => 'integer',
        'purchase_year' => 'integer',
    ];
}