<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costumers;

class DashboardController extends Controller
{
    
    public function index()
    {
        $totalCostumers = Costumers::all()->count(); // Assuming you want to get the count of Costumers
        return view('pages.dashboard.index', compact('totalCostumers'));
    }
}
