<?php
// Controller: SalesController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\SparePart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
 // Import untuk type-hinting View

class SalesController extends Controller
{
    /**
     * Menampilkan daftar semua penjualan.
     */
    public function index(): View
    {
        // 1. Ambil data penjualan dengan Eager Loading
        // Eager loading relasi 'customer' untuk menghindari masalah N+1 Query.
        // Kita juga mengurutkan berdasarkan tanggal terbaru.
        $sales = Sales::with('customer') 
                      ->latest() // Urutkan berdasarkan created_at DESC (terbaru)
                      ->paginate(10); // Gunakan paginasi untuk performa

        // 2. Kirim data ke view
        return view('pages.sales.index', compact('sales'));
    }
    
    /**
     * Menampilkan form untuk membuat penjualan baru.
     */
    public function create(): View
    {
        // Ambil semua pelanggan dan sparepart untuk dropdown/lookup
        $customers = Customer::all();
        $spareparts = SparePart::all();
        
        return view('pages.sales.create', compact('customers', 'spareparts'));
    }

    /**
     * Menyimpan transaksi penjualan baru.
     * (Kode store yang sudah kita tinjau sebelumnya)
     */
    public function store(Request $request): RedirectResponse
    {
        // ... (Kode metode store yang sudah dibahas) ...
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_number' => 'required|string|unique:sales,invoice_number',
            'grand_total_submit' => 'required|numeric|min:0.01',
            'items' => 'required|array|min:1',
            'items.*.sparepart_id' => 'required|exists:spareparts,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalSale = 0;
            $salesItemsData = [];
            
            // Logika iterasi, hitung subtotal, dan kumpulkan data item
            foreach ($request->items as $item) {
                $price = (float)str_replace(['Rp', '.', ','], ['', '', '.'], $item['price']); 
                $quantity = (int) $item['quantity'];
                $subTotal = round($price * $quantity, 2); 

                $salesItemsData[] = new SalesItem([
                    'sparepart_id' => $item['sparepart_id'],
                    'quantity' => $quantity,
                    'price' => $price,
                    'sub_total' => $subTotal,
                ]);
                $totalSale += $subTotal;
                
                // Opsional: Pengurangan Stok di sini
                SparePart::where('id', $item['sparepart_id'])->decrement('stock', $quantity);
            }

            $sale = Sales::create([
                'invoice_number' => $request->invoice_number,
                'customer_id' => $request->customer_id,
                'total' => $totalSale, 
            ]);

            $sale->items()->saveMany($salesItemsData);
            
            DB::commit();

            return redirect()->route('sales.index', $sale->id)->with('success', 'Penjualan Berhasil Ditambahkan dan Stok Diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data penjualan: ' . $e->getMessage());
        }
    }
    
    /**
     * Menampilkan detail penjualan tertentu.
     */
    public function show($id): View
    {
        // Muat data penjualan, pelanggan, dan item
        $sale = Sales::with(['customer', 'items.sparepart'])->findOrFail($id);
        
        $bengkelInfo = [
            'name' => 'Tcs Motor',
            'address' => 'Jl. Raya Contoh No. 123',
            'phone' => '(021) 123-4567',
        ];

        return view('pages.sales.show', compact('sale', 'bengkelInfo'));
    }

}