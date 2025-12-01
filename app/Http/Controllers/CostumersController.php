<?php

namespace App\Http\Controllers;

use App\Models\Costumers;
use Illuminate\Http\Request;

class CostumersController extends Controller
{
    public function index(Request $request)
    {
        $costumers = Costumers::query()
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(5);
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

    public function edit(Request $request, $id)
    {
        $costumers = Costumers::find($id);
        return view('pages.costumers.edit', compact('costumers'));
    }

    public function update(Request $request, Costumers $costumers)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $costumers->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('costumers.index')->with('success', 'Costumers updated successfully');
    }

    // Pastikan Anda mengimpor Model yang benar di bagian atas file
// use App\Models\Customer; // Sesuaikan dengan path Model Anda

public function destroy(Costumers $costumer) // <-- Parameter diubah dari $costumers menjadi $costumer
{
    $costumer->delete(); // <-- Variabel diubah dari $costumers menjadi $costumer
    return redirect()->route('costumers.index')->with('success', 'Costumers deleted successfully');
}
}
