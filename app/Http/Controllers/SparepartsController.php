<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartsController extends Controller
{
    public function index()
    {
        return view('pages.spareparts.index');
    }

    public function create()
    {
        return view('pages.spareparts.create');
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);

        Sparepart::create([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'stock' => $request->stock,
            'price_buy' => $request->price_buy,
            'price_sell' => $request->price_sell,
        ]);
    }
}
