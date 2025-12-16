<?php

namespace App\Http\Controllers;

use App\Models\ServiceMaster;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ServiceMasterController extends Controller
{
    public function index()
    {
        $servicemasters = ServiceMaster::all();
        return view('pages.services_master.index', compact('servicemasters'));
    }

    public function create()
    {
        return view('pages.services_master.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:100',
            'service_price' => 'required|numeric',
        ]);

        ServiceMaster::create($validated);

        return redirect()->route('services-masters.index')->with('success', 'Service Master created successfully.');
    }
}
