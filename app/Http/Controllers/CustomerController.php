<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

// PERBAIKAN: Mengganti nama kelas menjadi CustomerController
class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index(): View
    {
        // Menggunakan paginate() yang lebih sederhana karena tampilan index akan menggunakan DataTables (AJAX)
        // Jika tidak menggunakan DataTables (AJAX) dan ingin menampilkan data langsung:
        $customers = Customer::query()
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        // PERBAIKAN: Mengubah nama view agar konsisten dengan rute dan controller
        return view('pages.customers.index', compact('customers'));
    }

    /**
     * Menampilkan formulir untuk membuat pelanggan baru.
     */
    public function create(): View
    {
        return view('pages.customers.create');
    }

    /**
     * Menyimpan pelanggan yang baru dibuat ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // PERBAIKAN: Menambahkan validasi 'unique' untuk email
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email|max:100', // Unique di tabel 'customers'
            'phone' => 'nullable|string|max:20', // Mengubah ke nullable
            'address' => 'nullable|string', // Mengubah ke nullable
        ]);

        Customer::create($validated); // Langsung masukkan $validated array

        // PERBAIKAN: Mengubah nama rute menjadi 'customers.index' (konvensi resource)
        return redirect()->route('customers.index')->with('success', 'Pelanggan **' . $validated['name'] . '** berhasil dibuat!');
    }

    /**
     * Menampilkan pelanggan tertentu (opsional, tergantung kebutuhan).
     */
    public function show(Customer $customer): View
    {
        // Route Model Binding sudah otomatis menemukan Customer, tidak perlu pengecekan
        return view('pages.customers.show', compact('customer'));
    }

    /**
     * Menampilkan formulir untuk mengedit pelanggan tertentu.
     */
    public function edit(Customer $customer): View
    {
        // Route Model Binding sudah otomatis menemukan Customer
        return view('pages.customers.edit', compact('customer'));
    }

    /**
     * Memperbarui pelanggan yang ditentukan di database.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        // PERBAIKAN: Validasi 'unique' harus mengabaikan email pelanggan saat ini
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:customers,email,',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan **' . $customer->name . '** Berhasil Diperbarui.');
    }

    /**
     * Menghapus pelanggan tertentu dari database.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        // PERBAIKAN: Route Model Binding sudah memastikan objek ada
        $customerName = $customer->name;
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Pelanggan **' . $customerName . '** Berhasil Dihapus.');
    }
}