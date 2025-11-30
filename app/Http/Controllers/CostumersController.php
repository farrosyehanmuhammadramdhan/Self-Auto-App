<?php

namespace App\Http\Controllers;

use App\Models\Costumers;
use Illuminate\Http\Request;

class CostumersController extends Controller
{
    public function index()
    {
        $costumers = Costumers::all();
        return view('pages.costumers.index', compact('costumers'));
    }

    public function create()
    {
        return view('pages.costumers.create');
    }

    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        Costumers::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('costumers.index')->with('success', 'Costumers created successfully');
    }
}
