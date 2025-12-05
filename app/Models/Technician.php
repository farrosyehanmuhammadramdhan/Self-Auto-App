<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    // protected $table = 'technicians'; // Dihapus karena sesuai konvensi

    protected $fillable = [
        'name',
        'skill', // Disesuaikan dari 'skills' menjadi 'skill'
        'is_active', // Disesuaikan dari 'status' menjadi 'is_active'
    ];
    
    // Opsional: Untuk mengaktifkan fitur Mass Assignment dengan aman
    use HasFactory; 

    // Relasi (tidak diubah, tetapi disertakan untuk kelengkapan)
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}