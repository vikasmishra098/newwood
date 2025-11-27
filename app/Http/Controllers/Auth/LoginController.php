<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle login with either email or employee ID.
     */
    public function login(Request $request)
    {
        // ✅ Validate form inputs
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($request->input('login'));

        // ✅ Detect if input is an email or employee ID
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
            $loginValue = strtolower($loginInput); // make email case-insensitive
        } else {
            $fieldType = 'employee_id';
            $loginValue = strtoupper($loginInput); // e.g., emp001 → EMP001
        }

        // ✅ Fetch user before attempt (to check block status)
        $user = User::where($fieldType, $loginValue)->first();

        if ($user && $user->is_blocked == 1) {
            // ❌ Blocked users cannot log in
            return back()->withErrors([
                'login' => 'Your account has been blocked. Please contact the administrator.',
            ])->onlyInput('login');
        }

        // ✅ Try to log in
        if (Auth::attempt([$fieldType => $loginValue, 'password' => $request->password], $request->filled('remember'))) {
            return redirect()->intended($this->redirectTo);
        }

        // ❌ If login fails
        return back()->withErrors([
            'login' => 'Invalid credentials. Please check your email or employee ID and password.',
        ])->onlyInput('login');
    }
}
