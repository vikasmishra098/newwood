<?php
namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('subadmin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('subadmin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:6',
            'employee_id'       => 'required|unique:users',
            'user_phone_number' => 'required|string|max:15', // ✅ added phone validation
            'is_blocked'        => 'nullable|boolean',
        ]);

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'role'              => 'customer',
            'password'          => bcrypt($request->password),
            'employee_id'       => $request->employee_id,
            'user_phone_number' => $request->user_phone_number, // ✅ save phone number
            'is_blocked'        => $request->is_blocked ?? 0,
        ]);

        return redirect()->route('subadmin.customers.index')
                         ->with('success', 'Customer created successfully');
    }

    public function edit(User $customer)
    {
        return view('subadmin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,' . $customer->id,
            'employee_id'       => 'required|unique:users,employee_id,' . $customer->id,
            'user_phone_number' => 'required|string|max:15', // ✅ added phone validation
            'is_blocked'        => 'nullable|boolean',
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->employee_id = $request->employee_id;
        $customer->user_phone_number = $request->user_phone_number; // ✅ save phone number
        $customer->is_blocked = $request->is_blocked ?? 0;

        if ($request->filled('password')) {
            $customer->password = bcrypt($request->password);
        }

        $customer->save();

        return redirect()->route('subadmin.customers.index')
                         ->with('success', 'Customer updated successfully');
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('subadmin.customers.index')
                         ->with('success', 'Customer deleted successfully');
    }
}
