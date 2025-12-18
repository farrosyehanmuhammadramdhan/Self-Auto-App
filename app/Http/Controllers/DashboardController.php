<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\VehicleMaster;
use App\Models\SparePart;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::count();
        $vehicles = VehicleMaster::count();
        $spareparts = Sparepart::where('stock', '=', 0)->get();
        return view('pages.dashboard.index', compact('customers', 'vehicles', 'spareparts'));
    }
}
