<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ganti 'technician' menjadi 'technicians'
        Schema::create('technicians', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->string('skill'); // Diubah dari 'skills' menjadi 'skill'
            $table->boolean('is_active')->default(true); // Status Aktif/Tidak Aktif
            $table->timestamps(); // Menggantikan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ganti 'technician' menjadi 'technicians'
        Schema::dropIfExists('technicians'); 
    }
};