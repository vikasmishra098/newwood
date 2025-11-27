<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Show only non-admin users
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'employee_id'       => 'required|string|unique:users,employee_id',
            'password'          => 'required|min:6',
            'role'              => 'required|in:subadmin,customer',
            'user_phone_number' => 'required|string|max:15', // ✅ added phone validation
            'is_blocked'        => 'nullable|boolean',
        ]);

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'employee_id'       => strtoupper($request->employee_id),
            'role'              => $request->role,
            'password'          => bcrypt($request->password),
            'user_phone_number' => $request->user_phone_number, // ✅ save phone number
            'is_blocked'        => $request->is_blocked ?? 0,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'employee_id'       => 'required|string|unique:users,employee_id,' . $user->id,
            'role'              => 'required|in:subadmin,customer',
            'user_phone_number' => 'required|string|max:15', // ✅ update phone validation
            'is_blocked'        => 'nullable|boolean',
        ]);

        $data = [
            'name'              => $request->name,
            'email'             => $request->email,
            'employee_id'       => strtoupper($request->employee_id),
            'role'              => $request->role,
            'user_phone_number' => $request->user_phone_number, // ✅ update phone number
            'is_blocked'        => $request->is_blocked ?? 0,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully');
    }
}
