<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::all();
        $viewPath = auth()->user()->role === 'admin' 
            ? 'admin.warranties.index' 
            : 'subadmin.warranties.index';

        return view($viewPath, compact('warranties'));
    }

    public function create()
    {
        $viewPath = auth()->user()->role === 'admin' 
            ? 'admin.warranties.create' 
            : 'subadmin.warranties.create';

        return view($viewPath);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pin' => 'nullable|string|max:20',
            'dealer_name' => 'nullable|string|max:255',
            'dealer_email' => 'nullable|email|max:255',
            'dealer_phone' => 'nullable|string|max:20',
            'dealer_address' => 'nullable|string|max:255',
            'dealer_city' => 'nullable|string|max:100',
            'dealer_state' => 'nullable|string|max:100',
            'ppf_category' => 'nullable|string|max:100',
            'chassis_no' => 'nullable|string|max:100',
            'year' => 'nullable|digits:4',
            'package' => 'nullable|string|max:100',
            'warranty' => 'nullable|string|max:100',
            'replacement_warranty' => 'nullable|string|max:100',
            'validity' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'vehicle_number' => 'nullable|string|max:100',
            'mobile_number' => 'required|string|max:15',
            'date' => 'nullable|date',
        ]);

        Warranty::create($validated);

        return redirect()->route('admin.warranties.index')->with('success', 'Warranty created successfully.');
    }

    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);
        $viewPath = auth()->user()->role === 'admin' 
            ? 'admin.warranties.edit' 
            : 'subadmin.warranties.edit';

        return view($viewPath, compact('warranty'));
    }

    public function update(Request $request, $id)
    {
        $warranty = Warranty::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pin' => 'nullable|string|max:20',
            'dealer_name' => 'nullable|string|max:255',
            'dealer_email' => 'nullable|email|max:255',
            'dealer_phone' => 'nullable|string|max:20',
            'dealer_address' => 'nullable|string|max:255',
            'dealer_city' => 'nullable|string|max:100',
            'dealer_state' => 'nullable|string|max:100',
            'ppf_category' => 'nullable|string|max:100',
            'chassis_no' => 'nullable|string|max:100',
            'year' => 'nullable|digits:4',
            'package' => 'nullable|string|max:100',
            'warranty' => 'nullable|string|max:100',
            'replacement_warranty' => 'nullable|string|max:100',
            'validity' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'vehicle_number' => 'nullable|string|max:100',
            'mobile_number' => 'required|string|max:15',
            'date' => 'nullable|date',
        ]);

        $warranty->update($validated);

        return redirect()->route('admin.warranties.index')->with('success', 'Warranty updated successfully.');
    }
}
