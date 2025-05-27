<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = Rental::selectRaw('DATE(start_date) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return view('admin.dashboard', compact('data'));
    }
}
