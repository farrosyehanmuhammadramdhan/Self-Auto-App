<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceMaster;
use App\Models\Sparepart;
use App\Models\Technician;
use App\Models\VehicleMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('pages.services.index', compact('services'));
    }

    public function create()
    {
        $vehicles = VehicleMaster::all();
        $technicians = Technician::all();
        $spareparts = Sparepart::where('stock', '>', 0)->get();
        $service_masters = ServiceMaster::all();

        return view('pages.services.create', compact('vehicles', 'technicians', 'spareparts', 'service_masters'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi diperketat untuk menghindari data null pada sparepart


        try {
            DB::beginTransaction();

            // 1. Simpan Header Service
            $service = Service::create([
                'vehicle_master_id' => $request->vehicle_master_id,
                'technician_id'     => $request->technician_id,
                'service_date'      => $request->service_date,
                'type'              => $request->type,
                'status'            => 'Pending',
                'total_price'       => $request->grand_total_submit,
                'notes'             => $request->notes
            ]);

            //2. Simpan Detail Jasa Service (Gunakan Eloquent Relationship untuk efisiensi)
            $serviceItems = collect($request->service_items)->map(function ($item) {
                return [
                    'service_master_id' => $item['service_master_id'],
                    'price'             => $item['price'],
                ];
            });
            $service->items()->createMany($serviceItems->toArray());

            // 3. Simpan Detail Sparepart (Jika ada)
            if ($request->filled('sparepart_items')) {
                foreach ($request->sparepart_items as $sp) {
                    $service->spareparts()->create([
                        'sparepart_id' => $sp['sparepart_id'],
                        'quantity'     => $sp['quantity'],
                        'price'        => $sp['price']
                    ]);

                    // //         // Logika potong stok (Opsional: Pastikan field 'stock' ada di tabel spareparts)
                    // //         // Sparepart::find($sp['sparepart_id'])->decrement('stock', $sp['quantity']);
                }
            }

            DB::commit();
            //dd($service);

            // Perbaikan: route index biasanya tidak membutuhkan ID, jika ingin ke detail gunakan route 'services.show'
            return redirect()->route('services.index')->with('success', 'Data service berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // public function show(Service $service) : View
    // {
    //     return view('pages.services.show', compact('service'));
    // }

    public function edit($id)
    {
        $service = Service::with(['items', 'spareparts', 'vehicle', 'technician'])->findOrFail($id);
        $technicians = Technician::all();

        // Ambil data master untuk pilihan dropdown
        $serviceMasters = ServiceMaster::all();
        $spareparts = Sparepart::all();

        return view('pages.services.edit', compact('service', 'technicians', 'serviceMasters', 'spareparts'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'status' => 'required',
            'technician_id' => 'required',
            'service_date' => 'required|date',
        ]);

        $service = Service::findOrFail($id);

        // 2. Update Data Utama Service
        $service->update([
            'type' => $request->type,
            'status' => $request->status,
            'technician_id' => $request->technician_id,
            'service_date' => $request->service_date,
            'notes' => $request->notes,
        ]);

        // 3. Update Detail Jasa (Service Items)
        // Hapus yang lama, masukkan yang baru
        $service->items()->delete();
        $totalServicePrice = 0;

        if ($request->has('service_master_ids')) {
            foreach ($request->service_master_ids as $key => $masterId) {
                $price = $request->service_prices[$key] ?? 0;
                $service->items()->create([
                    'service_master_id' => $masterId,
                    'price' => $price,
                ]);
                $totalServicePrice += $price;
            }
        }

        // 4. Update Detail Sparepart
        // Hapus yang lama, masukkan yang baru
        $service->spareparts()->delete();
        $totalSparepartPrice = 0;

        if ($request->has('sparepart_ids')) {
            foreach ($request->sparepart_ids as $key => $sparepartId) {
                $qty = $request->sparepart_qtys[$key] ?? 0;
                $price = $request->sparepart_prices[$key] ?? 0;
                $subtotal = $qty * $price;

                $service->spareparts()->create([
                    'sparepart_id' => $sparepartId,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
                $totalSparepartPrice += $subtotal;
            }
        }

        // 5. Update Total Biaya Keseluruhan di tabel Service
        $service->update([
            'total_price' => $totalServicePrice + $totalSparepartPrice
        ]);

        return redirect()->route('services.index')->with('success', 'Data service berhasil diperbarui!');
    }

    public function show($id)
    {
        $service = Service::with(['items', 'spareparts'])->find($id);
        return view('pages.services.show', compact('service'));
    }
}
