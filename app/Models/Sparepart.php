<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category',
        'stock',
        'price_buy',
        'price_sell',
    ];
}
