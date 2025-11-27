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
        return view('subadmin.warranties.index', compact('warranties'));
    }

    public function create()
    {
        return view('subadmin.warranties.create');
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

    return redirect()->route('subadmin.warranties.index')->with('success', 'Warranty added successfully.');
}

    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);
        return view('subadmin.warranties.edit', compact('warranty'));
    }

    

    public function update(Request $request, $id)
    {
        $data = $this->validateData($request);
        Warranty::findOrFail($id)->update($data);
        return redirect()->route('subadmin.warranties.index')->with('success', 'Warranty updated successfully.');
    }

    protected function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:15',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pin' => 'nullable|string',
            'dealer_name' => 'nullable|string',
            'dealer_email' => 'nullable|email',
            'dealer_phone' => 'nullable|string',
            'dealer_address' => 'nullable|string',
            'dealer_city' => 'nullable|string',
            'dealer_state' => 'nullable|string',
            'ppf_category' => 'nullable|string',
            'chassis_no' => 'nullable|string',
            'year' => 'nullable|digits:4',
            'package' => 'nullable|string',
            'warranty' => 'nullable|string',
            'replacement_warranty' => 'nullable|string',
            'validity' => 'nullable|string',
            'model' => 'nullable|string',
            'vehicle_number' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
    }
}
