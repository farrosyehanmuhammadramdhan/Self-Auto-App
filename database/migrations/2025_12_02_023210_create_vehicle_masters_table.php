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
        Schema::create('vehicle_masters', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel customers
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            // Data Kendaraan
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->year('model_year'); // Menggunakan tipe year()
            $table->string('type', 100);
            $table->enum('wheels', [2, 3, 4, 6, 8, 10])->default(2); // Enum untuk jumlah roda
            $table->string('license_plate', 20)->unique();
            $table->string('color', 50);
            $table->string('vin', 100)->unique(); // Nomor VIN/Rangka
            $table->string('engine_number', 100)->nullable()->unique(); // Nomor Mesin (Nullable jika opsional, tapi biasanya unik)
            $table->year('purchase_year'); // Tahun Pembelian
            $table->text('note')->nullable(); // Catatan tambahan (optional)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_masters');
    }
};