<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Category; // Import model Category
use Illuminate\Http\Request;

class SparepartsController extends Controller
{
    /**
     * Display a listing of the resource. (index)
     */
    public function index(Request $request)
    {
        // Ambil data sparepart, urutkan, dan tambahkan paginasi
        $spareparts = Sparepart::query()
            ->with('category') // Eager loading relasi 'category'
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    // Mencari berdasarkan nama kategori (melalui relasi)
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10); // Tambahkan paginasi

        // Ganti 'spareparts' di compact menjadi 'spareparts' untuk view
        return view('pages.spareparts.index', compact('spareparts'));
    }

    /**
     * Show the form for creating a new resource. (create)
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::orderBy('name')->get();
        return view('pages.spareparts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage. (store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:spareparts,code', // Tambahkan validasi unique
            'category_id' => 'required|exists:categories,id', // Validasi Foreign Key
            'stock' => 'nullable|integer|min:0', // Stok bisa opsional/null
            'price_buy' => 'required|integer|min:0',
            'price_sell' => 'required|integer|min:0',
        ], [
            // Pesan validasi khusus (Opsional)
            'category_id.required' => 'Kolom Kategori wajib diisi.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        Sparepart::create([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id, // Gunakan category_id
            'stock' => $request->stock ?? 0, // Ambil stock, default 0
            'price_buy' => $request->price_buy,
            'price_sell' => $request->price_sell,
        ]);

        return redirect()->route('spareparts.index')->with('success', 'Sparepart Berhasil Ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource. (edit)
     */
    public function edit(Sparepart $sparepart) // Gunakan Route Model Binding
    {
        $categories = Category::orderBy('name')->get(); // Ambil semua kategori
        // Dengan Route Model Binding, $sparepart sudah berisi data yang dicari
        return view('pages.spareparts.edit', compact('sparepart', 'categories'));
    }

    /**
     * Update the specified resource in storage. (update)
     */
    public function update(Request $request, Sparepart $sparepart) // Gunakan Route Model Binding
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Validasi unique diabaikan untuk data saat ini
            'code' => 'required|string|max:50|unique:spareparts,code,' . $sparepart->id,
            'category_id' => 'required|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'price_buy' => 'required|integer|min:0',
            'price_sell' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Kolom Kategori wajib diisi.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        $sparepart->update([ // Update model yang sudah di-bind
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id, // Gunakan category_id
            'stock' => $request->stock ?? 0,
            'price_buy' => $request->price_buy,
            'price_sell' => $request->price_sell,
        ]);

        return redirect()->route('spareparts.index')->with('success', 'Sparepart Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (destroy)
     */
    public function destroy(Sparepart $sparepart) // Gunakan Route Model Binding
    {
        $sparepart->delete(); // Hapus model yang sudah di-bind
        return redirect()->route('spareparts.index')->with('success', 'Sparepart Berhasil Dihapus.');
    }
}