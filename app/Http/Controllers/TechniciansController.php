<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechniciansController extends Controller
{
    public function index()
    {
        return view('pages.technicians.index');
    }

    public function create()
    {
        return view('pages.technicians.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'status' => 'required',
        ]);

        TechniciansController::create([
            'name' => $request->name,
            'skill' => $request->skill,
            'status' => $request->status,
        ]);

        return redirect()->route('technicians.index')->with('success', 'Teknisi Berhasil Dibuat.');
    }
}
