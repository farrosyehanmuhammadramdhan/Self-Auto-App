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
            $table->foreignId('costumers_id')->references('id')->on('costumers')->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->integer('model_year');
            $table->string('plate_number');
            $table->string('engine_number');
            $table->integer('purchase_year');
            $table->enum('wheel', ['2', '4'])->default('2');
            $table->string('type');
            $table->string('color');
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
