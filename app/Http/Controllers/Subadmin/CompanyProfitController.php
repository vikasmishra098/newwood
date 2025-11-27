<?php

namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfit;

class CompanyProfitController extends Controller
{
    public function create()
    {
        return view('subadmin.companyprofit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'profit_amount' => 'required|numeric',
            'loss_amount' => 'required|numeric',
            'entry_date' => 'required|date',
        ]);

        CompanyProfit::create([
            'profit_amount' => $request->profit_amount,
            'loss_amount' => $request->loss_amount,
            'entry_date'    => $request->entry_date,
        ]);

        return redirect()->route('subadmin.companyprofit.view')->with('success', 'Record Added Successfully!');
    }

   public function view(Request $request)
{
    $years = \App\Models\CompanyProfit::selectRaw('YEAR(entry_date) as year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    $query = \App\Models\CompanyProfit::query();

    // Agar year select kiya hai
    if ($request->filled('year')) {
        $query->whereYear('entry_date', $request->year);
    }

    $profits = $query->get();

    // ✅ Total profit & loss calculate sirf selected year ke liye
    $totalProfit = $query->sum('profit_amount');
    $totalLoss   = $query->sum('loss_amount');

    return view('subadmin.companyprofit.view', compact('profits', 'years', 'totalProfit', 'totalLoss'));
}

}
