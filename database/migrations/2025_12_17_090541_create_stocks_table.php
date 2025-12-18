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
        Schema::create('stocks', function (Blueprint $table) {
            $table->foreignId('sparepart_id')->constrained('spareparts')->onDelete('cascade');
            $table->integer('quantity'); // Jumlah stok yang masuk/keluar
            $table->text('description')->nullable(); // Keterangan transaksi
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
