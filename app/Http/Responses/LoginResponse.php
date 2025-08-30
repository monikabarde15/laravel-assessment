<?php 
// app/Http/Responses/LoginResponse.php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return redirect()->route('dashboard'); // fallback
    }
}
