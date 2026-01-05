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
        // Ambil data service beserta relasi item-nya
        $service = Service::with(['items', 'spareparts'])->findOrFail($id);

        // Ambil data master untuk dropdown
        $vehicles = VehicleMaster::with('customer')->get();
        $technicians = Technician::all();
        $service_masters = ServiceMaster::all();
        $spareparts = Sparepart::where('stock', '>', 0)->get(); // Atau ambil semua jika ingin menampilkan history

        return view('pages.services.edit', compact('service', 'vehicles', 'technicians', 'service_masters', 'spareparts'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'vehicle_master_id' => 'required|exists:vehicle_masters,id',
            'technician_id'     => 'required|exists:technicians,id',
            'service_date'      => 'required|date',
            'type'              => 'required|in:Servis Berkala,Perbaikan,Darurat,Lainnya',
            'status'            => 'required|in:Pending,Sedang_dikerjakan,Selesai,Dibatalkan',
            'notes'             => 'nullable|string',

            // Validasi Array Service Items
            'service_items'     => 'required|array',
            'service_items.*.service_master_id' => 'required|exists:service_masters,id',
            'service_items.*.price'             => 'required|numeric|min:0',

            // Validasi Array Sparepart Items (Nullable/Optional)
            'sparepart_items'   => 'nullable|array',
            'sparepart_items.*.sparepart_id' => 'required|exists:spareparts,id',
            'sparepart_items.*.quantity'     => 'required|integer|min:1',
            'sparepart_items.*.price'        => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $service = Service::findOrFail($id);
                $totalPrice = 0;

                // 2. Update Data Utama
                $service->update([
                    'vehicle_master_id' => $request->vehicle_master_id,
                    'technician_id'     => $request->technician_id,
                    'service_date'      => $request->service_date,
                    'type'              => $request->type,
                    'status'            => $request->status, // Field baru di edit
                    'notes'             => $request->notes,
                ]);

                // 3. Proses Service Items (Jasa)
                // Hapus data lama
                $service->serviceItems()->delete();

                // Simpan data baru dari form
                if ($request->has('service_items')) {
                    foreach ($request->service_items as $item) {
                        $service->serviceItems()->create([
                            'service_master_id' => $item['service_master_id'],
                            'price'             => $item['price'],
                        ]);
                        $totalPrice += $item['price'];
                    }
                }

                // 4. Proses Sparepart Items
                // Hapus data lama
                // Catatan: Jika ada logika stok, kembalikan stok lama dulu di sini sebelum delete
                $service->sparepartItems()->delete();

                if ($request->has('sparepart_items')) {
                    foreach ($request->sparepart_items as $item) {
                        $subtotal = $item['quantity'] * $item['price'];
                        $service->sparepartItems()->create([
                            'sparepart_id' => $item['sparepart_id'],
                            'quantity'     => $item['quantity'],
                            'price'        => $item['price'],
                            'subtotal'     => $subtotal,
                        ]);
                        $totalPrice += $subtotal;

                        // Catatan: Kurangi stok baru di sini jika diperlukan
                    }
                }

                // 5. Update Total Price di table parent
                $service->update(['total_price' => $totalPrice]);
            });

            return redirect()->route('services.index')->with('success', 'Data Service berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
