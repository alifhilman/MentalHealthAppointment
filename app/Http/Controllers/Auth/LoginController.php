<?php
// app/Http/Controllers/Auth/LoginController.php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->update(['last_login_at' => now()]);

        if ($user->role->name === 'doctor') {
            if ($user->status === 'pending_approval') {
                auth()->logout();
                return redirect()->route('auth.approval_required');
            } elseif ($user->status === 'rejected') {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your application has been rejected. Please contact support for further details.');
            }
        }
    }
}
