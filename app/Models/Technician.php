<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $table = 'technicians';

    protected $fillable = [
        'name', 
        'skills', 
        'status',
    ];
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
