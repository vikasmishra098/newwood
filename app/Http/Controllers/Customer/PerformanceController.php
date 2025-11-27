<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Performance;

class PerformanceController extends Controller
{
    public function __construct()
    {
        // Only authorized (logged-in) users can access this controller
        $this->middleware('auth');
    }

    public function index()
    {
        // Fetch performances only for logged-in user
        $performances = Performance::with('employee.company')
            ->where('user_id', auth()->id()) // ✅ Only current user
            ->latest()
            ->get();

        return view('customer.performance.performance', compact('performances'));
    }
}

