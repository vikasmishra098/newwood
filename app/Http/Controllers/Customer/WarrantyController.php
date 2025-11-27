<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::where('user_id', auth()->id())->get();
        return view('customer.warranties.index', compact('warranties'));
    }

    public function create()
    {
        return view('customer.warranties.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'mobile_number' => 'required',
        // add more validations as needed
    ]);

    $validated['user_id'] = auth()->id();

    dd($validated); // <--- this stops the code and shows the data
}



    public function edit($id)
    {
        $warranty = Warranty::where('user_id', auth()->id())->findOrFail($id);
        return view('customer.warranties.edit', compact('warranty'));
    }

    public function update(Request $request, $id)
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


        $warranty = Warranty::where('user_id', auth()->id())->findOrFail($id);
        $warranty->update($request->all());

        return redirect()->route('customer.warranties.index')->with('success', 'Warranty updated.');
    }

    public function destroy($id)
    {
        $warranty = Warranty::where('user_id', auth()->id())->findOrFail($id);
        $warranty->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
