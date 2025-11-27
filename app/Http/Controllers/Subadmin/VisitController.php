<?php

namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\User;
use App\Models\Company;

class VisitController extends Controller
{
    // Show all visits (adminIndex)
public function index(Request $request)
{
    $query = Visit::with('company');

    // Filter by month and year
    if ($request->filled('month')) {
        $query->whereMonth('date', $request->month);
    }

    if ($request->filled('year')) {
        $query->whereYear('date', $request->year);
    }

    $visits = $query->orderBy('date', 'desc')->get();

    return view('subadmin.visits.index', compact('visits'));
}

public function destroy($id)
{
    $visit = Visit::findOrFail($id);
    $visit->delete();

    return redirect()->route('subadmin.visits.index')->with('success', 'Visit deleted successfully.');
}



    // Show create visit form (adminCreate)
    public function create()
{
    $companies = Company::all();
    $employees = User::where('role', 'subadmin')->orWhere('role', 'customer')->get(); // or any role filter you want

    return view('subadmin.visits.create', compact('companies', 'employees'));
}

    // Store new visit (adminStore)
    public function store(Request $request)
    {
        $request->validate([
    'company_id'      => 'required|exists:companies,id',
    'date' => 'required|date',
    'employee_id' => 'required|exists:users,id',

    'machine_name'    => 'required|string',
    'add_parts'       => 'required|string',
    'required_parts'  => 'required|string',
    'receive_parts'   => 'required|string',
    'start_time'      => 'required|date_format:H:i', // ⏱ recommended time format (e.g., 14:30)
    'end_time'        => 'required|date_format:H:i',
    'who_solve'       => 'required|string',
    'problem'         => 'required|string',
    'status'          => 'required|string|in:pending,resolved,completed', // Optional: restrict valid statuses
]);


        Visit::create($request->all());

        return redirect()->route('subadmin.visits.index')->with('success', 'Visit created successfully.');
    }

  public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $employees = User::all(); // Required for dropdown in edit.blade.php
        $companies = Company::all(); // Also optional if you're editing company

        return view('subadmin.visits.edit', compact('visit', 'employees', 'companies'));
    }

    public function update(Request $request, $id)
    {
     $visit = Visit::findOrFail($id);

        $visit->update($request->all());

        return redirect()->route('subadmin.visits.index')->with('success', 'Visit updated!');
    }

}
