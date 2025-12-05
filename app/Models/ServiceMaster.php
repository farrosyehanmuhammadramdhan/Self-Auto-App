<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMaster extends Model
{
    protected $table = 'service_masters';
    protected $fillable = [
        'service_name',
        'service_price',
    ];
}
