<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan Anda memiliki model Category.php di App\Models\
// use App\Models\Category; // Tidak perlu jika sudah di-autoload, tapi baik untuk memastikan

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_id', // Diganti dari 'category' menjadi 'category_id'
        'stock',
        'price_buy',
        'price_sell',
    ];

    /**
     * Get the category that owns the sparepart.
     */
    public function category()
    {
        // Mendefinisikan relasi: satu sparepart dimiliki oleh satu category
        return $this->belongsTo(Category::class);
    }

    
}
