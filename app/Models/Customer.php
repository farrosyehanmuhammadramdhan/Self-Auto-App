<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Atribut yang harus diubah ke tipe data tertentu (casts).
     * Contoh: Tidak ada yang diperlukan di sini, tetapi baik untuk diketahui.
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}