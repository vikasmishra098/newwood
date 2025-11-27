<?php

namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::all();

        $role = auth()->user()->role;
        if ($role === 'admin') {
            return view('admin.warranties.index', compact('warranties'));
        } else {
            return view('subadmin.warranties.index', compact('warranties'));
        }
        
    }



   public function view($id)
{
    $warranty = Warranty::findOrFail($id); // get specific record

    $role = auth()->user()->role;
    if ($role === 'admin') {
        return view('admin.warranties.view', compact('warranty'));
    } else {
        return view('subadmin.warranties.view', compact('warranty'));
    }
}


    public function create()
    {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return view('admin.warranties.create');
        } else {
            return view('subadmin.warranties.create');
        }
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

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.warranties.index')->with('success', 'Warranty created successfully.');
        } else {
            return redirect()->route('subadmin.warranties.index')->with('success', 'Warranty created successfully.');
        }
    }

    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);

        $role = auth()->user()->role;
        if ($role === 'admin') {
            return view('admin.warranties.edit', compact('warranty'));
        } else {
            return view('subadmin.warranties.edit', compact('warranty'));
        }
    }



     public function view($id)
{
    $warranty = Warranty::findOrFail($id);

    $role = auth()->user()->role;
    if ($role === 'admin') {
        return view('admin.warranties.view', compact('warranty'));
    } else {
        return view('subadmin.warranties.view', compact('warranty'));
    }
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

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.warranties.index')->with('success', 'Warranty updated successfully.');
        } else {
            return redirect()->route('subadmin.warranties.index')->with('success', 'Warranty updated successfully.');
        }
    }
}
