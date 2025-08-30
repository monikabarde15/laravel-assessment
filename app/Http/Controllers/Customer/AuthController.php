<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // echo "dgd";die;
        // echo "<pre>";print_r($credentials);die; 

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid login details']);
    }

    public function showRegister()
    {
        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|confirmed'
        ]);

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.dashboard');
    }

    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}
