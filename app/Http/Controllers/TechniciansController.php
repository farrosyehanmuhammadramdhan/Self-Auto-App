<?php

namespace App\Http\Controllers;

use App\Models\Technician; // Import Model Technician
use Illuminate\Http\Request;

class TechniciansController extends Controller
{
    /**
     * Menampilkan daftar teknisi.
     */
    public function index()
    {
        // Ambil semua data teknisi, atau dengan paginasi
        $technicians = Technician::orderBy('name', 'asc')->paginate(10); 

        return view('pages.technicians.index', compact('technicians'));
    }

    /**
     * Menampilkan formulir untuk membuat teknisi baru.
     */
    public function create()
    {
        return view('pages.technicians.create');
    }

    /**
     * Menyimpan teknisi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|string', // Sesuaikan dengan nama kolom tabel 'skill'
            'is_active' => 'required|boolean', // Status adalah boolean (1/0)
        ], [
            'is_active.required' => 'Kolom status wajib diisi.',
            'is_active.boolean' => 'Kolom status harus berupa nilai boolean (Aktif/Tidak Aktif).',
        ]);

        Technician::create([ // Gunakan Model Technician
            'name' => $request->name,
            'skill' => $request->skill,
            'is_active' => $request->is_active, // Sesuaikan dengan nama kolom model 'is_active'
        ]);

        return redirect()->route('technicians.index')->with('success', 'Teknisi Berhasil Dibuat.');
    }

    /**
     * Menampilkan formulir untuk mengedit teknisi.
     */
    public function edit(Technician $technician) // Menggunakan Route Model Binding
    {
        return view('pages.technicians.edit', compact('technician'));
    }

    /**
     * Memperbarui data teknisi di database.
     */
    public function update(Request $request, Technician $technician) // Menggunakan Route Model Binding
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $technician->update([
            'name' => $request->name,
            'skill' => $request->skill,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('technicians.index')->with('success', 'Data Teknisi Berhasil Diperbarui.');
    }

    /**
     * Menghapus teknisi dari database.
     */
    public function destroy(Technician $technician) // Menggunakan Route Model Binding
    {
        $technician->delete();

        return redirect()->route('technicians.index')->with('success', 'Teknisi Berhasil Dihapus.');
    }
}