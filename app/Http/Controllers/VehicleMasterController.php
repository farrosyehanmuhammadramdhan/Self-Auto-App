<?php

namespace App\Http\Controllers;

use App\Models\VehicleMaster;
use App\Models\Customer; // Pastikan model Customer di-import
use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables; // Dihilangkan karena Datatables dihapus

class VehicleMasterController extends Controller
{
    /**
     * Tampilkan daftar Vehicle Master (menggunakan paginasi standar).
     */
    public function index(Request $request)
    {
        // Paginasi standar dengan pencarian
        $vehicle_masters = VehicleMaster::query()
            ->with('customer') // Eager loading relasi customer
            ->when($request->search, function ($query, $search) {
                // Pencarian berdasarkan model, plat nomor, atau nama customer
                $query->where('model', 'like', "%{$search}%")
                    ->orWhere('license_plate', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc') // Urutkan berdasarkan ID terbaru
            ->paginate(10); // Paginasi 10 data per halaman

        return view('pages.vehicles_master.index', compact('vehicle_masters'));
    }


    /**
     * Tampilkan form untuk membuat Vehicle Master baru.
     */
    public function create()
    {
        // 1. Ambil semua customer. Ubah nama variabel menjadi $customers untuk konsistensi.
        $customers = Customer::get();

        // 2. Opsi jumlah roda sudah benar, pertahankan.
        $wheelsOptions = [
            2 => '2 Roda (Motor)',
            3 => '3 Roda (Bajaj, dll)',
            4 => '4 Roda (Mobil)',
            6 => '6 Roda (Truk)',
            8 => '8 Roda',
            10 => '10 Roda'
        ];

        // 3. Kirim variabel yang sudah diubah namanya ke view.
        return view('pages.vehicles_master.create', compact('customers', 'wheelsOptions'));
    }

    /**
     * Simpan Vehicle Master yang baru dibuat.
     */
    public function store(Request $request)
    {
        $rules = [
            'customer_id' => 'required|exists:customers,id',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'model_year' => 'required|integer|digits:4',
            'type' => 'required|string|max:100',
            'wheels' => 'required|in:2,3,4,6,8,10',
            'license_plate' => 'required|string|max:20|unique:vehicle_masters,license_plate',
            'color' => 'required|string|max:50',
            'vin' => 'required|string|max:100|unique:vehicle_masters,vin',
            'engine_number' => 'nullable|string|max:100|unique:vehicle_masters,engine_number',
            'purchase_year' => 'required|integer|digits:4|max:' . date('Y'),
            'note' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        VehicleMaster::create($validatedData);

        return redirect()->route('vehicle-masters.index')->with('success', 'Master Kendaraan berhasil disimpan.');
    }

    /**
     * Tampilkan form untuk mengedit Vehicle Master.
     */
    public function edit(VehicleMaster $vehicleMaster)
    {
        // Ambil semua customer untuk Select2 (tanpa AJAX)
        $customers = Customer::get();

        $wheelsOptions = [
            2 => '2 Roda (Motor)',
            3 => '3 Roda (Bajaj, dll)',
            4 => '4 Roda (Mobil)',
            6 => '6 Roda (Truk)',
            8 => '8 Roda',
            10 => '10 Roda'
        ];

        return view('pages.vehicles_master.edit', compact('vehicleMaster', 'customers', 'wheelsOptions'));
    }

    /**
     * Update Vehicle Master yang ada.
     */
    public function update(Request $request, VehicleMaster $vehicleMaster)
    {
        $rules = [
            'customer_id' => 'required|exists:customers,id',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'model_year' => 'required|integer|digits:4',
            'type' => 'required|string|max:100',
            'wheels' => 'required|in:2,3,4,6,8,10',
            'license_plate' => 'required|string|max:20|unique:vehicle_masters,license_plate,' . $vehicleMaster->id,
            'color' => 'required|string|max:50',
            'vin' => 'required|string|max:100|unique:vehicle_masters,vin,' . $vehicleMaster->id,
            'engine_number' => 'nullable|string|max:100|unique:vehicle_masters,engine_number,' . $vehicleMaster->id,
            'purchase_year' => 'required|integer|digits:4|max:' . date('Y'),
            'note' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        $vehicleMaster->update($validatedData);

        return redirect()->route('vehicle-masters.index')->with('success', 'Master Kendaraan berhasil diperbarui.');
    }

    /**
     * Hapus Vehicle Master.
     */
    public function destroy(VehicleMaster $vehicleMaster)
    {
        $vehicleMaster->delete();
        return redirect()->route('vehicle-masters.index')->with('success', 'Master Kendaraan berhasil dihapus.');
    }
}
