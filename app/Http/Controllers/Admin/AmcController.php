<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class AmcController extends Controller

{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('admin.amcvisit.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.amcvisit.create');
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
        return redirect()->route('admin.amcvisit.index')->with('success', 'AMC record created successfully.');
    }

    return redirect()->route('admin.amcvisit.index')->with('success', 'Company created successfully.');
}



    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.amcvisit.edit', compact('company'));
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

        return redirect()->route('admin.amcvisit.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.amcvisit.index')->with('success', 'Company deleted successfully.');
    }
}
