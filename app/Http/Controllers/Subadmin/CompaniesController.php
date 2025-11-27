<?php

namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('subadmin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('subadmin.companies.create');
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
        'comservicehidden',
        'customer_phone',
        'cosmachinename',
        'cos_address',
        'cosmachinedetail',
        'cosspareparts',
        'cossparepartsrequired',
        'cosstatus',
    ]));

    
    if ($request->comservicehidden == '2') {
        return redirect()->route('amcvisit.companies.index')->with('success', 'AMC record created successfully.');
    }

    return redirect()->route('subadmin.companies.index')->with('success', 'Company created successfully.');
}



    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('subadmin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
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
            'customer_phone',
            'cosmachinename',
            'cos_address',
            'cosmachinedetail',
            'cosspareparts',
            'cossparepartsrequired',
            'cosstatus',
        ]));

        return redirect()->route('subadmin.companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('subadmin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
