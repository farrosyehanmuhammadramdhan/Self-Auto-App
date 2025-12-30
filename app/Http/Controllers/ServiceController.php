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
        // $request->validate([
        //     'vehicle_master_id' => 'required|exists:vehicle_masters,id',
        //     'technician_id'     => 'required|exists:technicians,id',
        //     'type'              => 'required|string',
        //     'grand_total_submit' => 'required|numeric',
        //     'service_items'     => 'required|array|min:1',
        //     'service_items.*.service_master_id' => 'required|exists:service_masters,id',
        //     'service_items.*.price'             => 'required|numeric',
        //     // Validasi sparepart jika ada
        //     'sparepart_items'   => 'nullable|array',
        //     'sparepart_items.*.sparepart_id'    => 'required_with:sparepart_items|exists:spareparts,id',
        //     'sparepart_items.*.quantity'        => 'required_with:sparepart_items|integer|min:1',
        //     'sparepart_items.*.price'           => 'required_with:sparepart_items|numeric',
        // ]);

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
        $service = Service::findOrFail($id);
        $vehicles = VehicleMaster::all();
        $technicians = Technician::all();
        return view('pages.services.edit', compact('service', 'vehicles', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update([
            'vehicle_master_id' => $request->vehicle_master_id,
            'technician_id'     => $request->technician_id,
            'service_date'      => $request->service_date,
            'type'              => $request->type,
            'status'            => $request->status,
            'total_price'       => $request->total_price,
            'notes'             => $request->notes
        ]);

        return redirect()->route('services.index')->with('success', 'Data service berhasil diperbarui!');
    }
}
