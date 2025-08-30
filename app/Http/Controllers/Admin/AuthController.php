<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate(); // 🔥 session fix
        return redirect()->intended(route('admin.dashboard')); 
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}


    public function showRegister()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:admins',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Account created successfully!');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // ✅ CSRF token refresh

        return redirect()->route('admin.login')
                         ->with('success', 'Logged out successfully.');
    }
}
