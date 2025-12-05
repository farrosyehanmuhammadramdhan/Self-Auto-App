<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'sparepart_id',
        'quantity',
        'price',
        'sub_total',
    ];

    // Casting untuk memastikan kolom uang/angka selalu berupa tipe data yang benar
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'sub_total' => 'decimal:2',
    ];

    /**
     * Relasi ke Penjualan (Sales).
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }

    /**
     * Relasi ke Sparepart.
     */
    public function sparepart(): BelongsTo
    {
        // Menggunakan foreign key standar (sparepart_id)
        return $this->belongsTo(SparePart::class);
    }
}