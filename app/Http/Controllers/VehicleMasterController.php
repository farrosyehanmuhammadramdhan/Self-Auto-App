<?php

namespace App\Http\Controllers;

use App\Models\VehicleMaster;
use Illuminate\Http\Request;

class VehicleMasterController extends Controller
{
    public function index()
    {
        
        $vehicle_masters = VehicleMaster::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('model', 'like', 'plate_number', 'like', "%{$search}%");
            })
            ->orderBy('id')
            ->paginate(10);
        return view('pages.vehicles_master.index')->with('vehicle_masters', $vehicle_masters);
    }

    public function create()
    {
        return view('pages.vehicles_master.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'type' => 'required',
            'wheels' => 'required',
            'license_plate' => 'required',
            'vin' => 'required',
            'engine_number' => 'required',
            'color' => 'required',
            'purchase_year' => 'required|numeric',
            'notes' => 'nullable'
        ]);

        $vehicleMaster = VehicleMaster::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'type' => $request->type,
            'wheels' => $request->wheels,
            'license_plate' => $request->license_plate,
            'vin' => $request->vin,
            'engine_number' => $request->engine_number,
            'color' => $request->color,
            'purchase_year' => $request->purchase_year,
            'notes' => $request->notes,
        ]);

        return redirect()->route('vehicle-masters.index')->with('vehicle_master', $vehicleMaster, 'success', 'Vehicle Master Berhasil Dibuat.');
    }

    
}
