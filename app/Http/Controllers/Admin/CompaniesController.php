<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'customer_name' => 'required|string|max:255',
        'comservicehidden' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:255',
        'cosmachinename' => 'required|string|max:255',
        'cos_address' => 'required|string|max:255',
        'cosmachinedetail' => 'required|string|max:255',
        'cosspareparts' => 'required|string|max:255',
        'cossparepartsrequired' => 'required|string|max:255',
        'cosstatus' => 'required|string|max:255',
    ]);

    Company::create($request->only([
        'name',
        'customer_name',
        'comservicehidden', // ✅ added here
        'customer_phone',
        'cosmachinename',
        'cos_address',
        'cosmachinedetail',
        'cosspareparts',
        'cossparepartsrequired',
        'cosstatus',
    ]));

    return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
}


    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'customer_name' => 'required|string|max:255',
        'comservicehidden' => 'nullable|string|max:255',
        'customer_phone' => 'required|string|max:255',
        'cosmachinename' => 'required|string|max:255',
        'cos_address' => 'required|string|max:255',
        'cosmachinedetail' => 'required|string|max:255',
        'cosspareparts' => 'required|string|max:255',
        'cossparepartsrequired' => 'required|string|max:255',
        'cosstatus' => 'required|string|max:255',
    ]);

    $company = Company::findOrFail($id);
    $company->update($request->only([
        'name',
        'customer_name',
        'comservicehidden', // ✅ added here
        'customer_phone',
        'cosmachinename',
        'cos_address',
        'cosmachinedetail',
        'cosspareparts',
        'cossparepartsrequired',
        'cosstatus',
    ]));

    return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
}


    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
