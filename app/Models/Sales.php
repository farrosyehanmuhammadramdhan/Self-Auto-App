<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sales extends Model
{
    use HasFactory;
    
    // Type-hinting untuk properti yang diisi
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'total',
    ];

    // Casting untuk memastikan kolom uang selalu berupa float/decimal saat diakses
    protected $casts = [
        'total' => 'decimal:2', 
    ];

    /**
     * Relasi ke Customer.
     */
    public function customer(): BelongsTo
    {
        // 'customer_id' bisa NULL (Pelanggan Umum), tapi relasi tetap berfungsi
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relasi ke Sales Items.
     */
    public function items(): HasMany
    {
        // Satu Penjualan memiliki banyak Item Penjualan
        return $this->hasMany(SalesItem::class, 'sale_id');
    }
}