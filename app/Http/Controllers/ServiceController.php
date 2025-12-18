<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceSparepartItem;
use App\Models\ServiceItem;
use App\Models\ServiceMaster;
use App\Models\Sparepart;
use App\Models\Technician;
use App\Models\VehicleMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return view('pages.services.index');
    }

    public function create()
    {
        $vehicles = VehicleMaster::all();
        $technicians = Technician::all();
        $spareparts = Sparepart::where('stock', '>', 0)->get();
        $service_masters = ServiceMaster::all(); // Daftar jasa service (Ganti oli, dll)

        return view('pages.services.create', compact('vehicles', 'technicians', 'spareparts', 'service_masters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_master_id' => 'required',
            'technician_id' => 'required',
            'service_items' => 'required|array|min:1', // Wajib minimal 1 item service
            'service_items.*.service_master_id' => 'required',
            'service_items.*.price' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // 1. Simpan Data Utama Service
            $service = Service::create([
                'vehicle_master_id' => $request->vehicle_master_id,
                'technician_id' => $request->technician_id,
                'type' => $request->type,
                'status' => 'pending',
                'total_price' => $request->grand_total_submit,
            ]);

            // 2. Simpan Detail Jasa Service
            foreach ($request->service_items as $item) {
                ServiceItem::create([
                    'service_id' => $service->id,
                    'service_master_id' => $item['service_master_id'],
                    'price' => $item['price'] // Pastikan field ini ada di migration atau simpan di service_master
                ]);
            }

            // 3. Simpan Detail Sparepart (Jika ada)
            if ($request->has('sparepart_items')) {
                foreach ($request->sparepart_items as $sp) {
                    ServiceSparepartItem::create([
                        'service_id' => $service->id,
                        'sparepart_id' => $sp['sparepart_id'],
                        'quantity' => $sp['quantity'],
                        'price' => $sp['price']
                    ]);

                    // Logika potong stok sparepart bisa ditambahkan di sini
                }
            }

            DB::commit();
            return redirect()->route('services.index')->with('success', 'Data service berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
