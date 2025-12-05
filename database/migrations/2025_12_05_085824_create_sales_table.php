<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            // Kolom utama penjualan
            $table->string('invoice_number', 50)->unique(); // Nomor Invoice: Wajib unik
            
            // Foreign Key ke tabel 'customers'. Menggunakan 'cascade' adalah opsional, 
            // namun di sini kita asumsikan customer tidak akan sering dihapus.
            // Jika customer dihapus, penjualan terkait akan diset NULL.
            $table->foreignId('customer_id')
                  ->nullable() // Memungkinkan penjualan ke 'Pelanggan Umum' (NULL)
                  ->constrained('customers')
                  ->onDelete('set null'); 
                  
            // Total: Selalu gunakan tipe DECIMAL untuk nilai mata uang.
            // Presisi (15, 2) adalah standar baik untuk keuangan.
            $table->decimal('total', 15, 2)->default(0); 

            // Metadata
            $table->timestamps();
            
            // Tambahan: Index untuk pencarian cepat
            $table->index('invoice_number'); 
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};