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
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code'); // Tambahkan unique untuk kode agar lebih baik
            $table->foreignId('category_id')->references('id')->on('categories')->constrained()->onDelete('cascade');
            $table->integer('stock')->default(0); // Tambahkan default(0) agar lebih baik
            $table->bigInteger('price_buy'); // Ganti integer menjadi bigInteger untuk harga, atau tetap integer jika range harga kecil
            $table->bigInteger('price_sell'); // Ganti integer menjadi bigInteger
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
