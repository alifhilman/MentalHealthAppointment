<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if (Auth::check() && Auth::user()->role->name == 'patient') {
        //         // For patients, apply the '2fa' middleware
        //         $this->middleware('2fa');
        //     }
        //     // For doctors, no additional middleware needed
        //     // For other roles, adjust as necessary
        //     return $next($request);
        // });
    }

    public function index()
    {
        // Display appropriate dashboard based on user role
        if (Auth::check()) {
            if (Auth::user()->role->name == 'patient') {
                return view('home');
            } elseif (Auth::user()->role->name == 'doctor') {
                return view('dashboard');
            }
        }

        // Default view if role is not matched
        return view('dashboard');
    }
}

