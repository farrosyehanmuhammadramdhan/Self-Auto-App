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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_master_id')->constrained('vehicle_masters')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('technicians')->onDelete('cascade');
            $table->date('service_date');
            $table->enum('type', ['Servis Berkala', 'Perbaikan', 'Darurat', 'Lainnya'])->default('Servis Berkala');
            $table->enum('status', ['Pending', 'Sedang_dikerjakan', 'Selesai', 'Dibatalkan'])->default('Pending');
            $table->decimal('total_price', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
