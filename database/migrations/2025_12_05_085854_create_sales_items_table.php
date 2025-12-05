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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke 'sales'
            // PENTING: Jika penjualan dihapus, itemnya HARUS ikut terhapus.
            $table->foreignId('sale_id')
                  ->constrained('sales')
                  ->onDelete('cascade'); 
                  
            // Foreign key ke 'spareparts'
            // Jika sparepart dihapus, baris item penjualan tetap ada, tapi sparepart_id menjadi NULL
            // Ini untuk menjaga histori, tapi membutuhkan penanganan di model (seperti yang Anda lakukan di view).
            $table->foreignId('sparepart_id')
                  ->nullable() 
                  ->constrained('spareparts')
                  ->onDelete('set null');

            // Detail Item Penjualan (Histori)
            $table->integer('quantity')->unsigned(); // Jumlah: Harus positif (unsigned)
            $table->decimal('price', 15, 2);      // Harga jual per satuan saat transaksi
            $table->decimal('sub_total', 15, 2);  // Subtotal baris ini (quantity * price)
            
            // Metadata
            $table->timestamps();
            
            // Tambahan: Composite Index untuk efisiensi query
            $table->index(['sale_id', 'sparepart_id']); 
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};