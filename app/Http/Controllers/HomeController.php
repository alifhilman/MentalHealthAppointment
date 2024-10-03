<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'auth' middleware to ensure authentication
        $this->middleware('auth');

        // Apply 2FA middleware only for patients
        // $this->middleware(function ($request, $next) {
        //     if (\Illuminate\Support\Facades\Auth::user()->role->name == "patient") {
        //         $this->middleware('auth','2fa');
        //     }
        //     return $next($request);
        // });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role->name=="admin"||Auth::user()->role->name="doctor"){
            return redirect('/dashboard');
        }
        
        $date = $request->input('date', date('Y-m-d')); // Default to current date if no date is provided
        $doctors = Doctor::where('available_date', $date)->get(); // Adjust the query as needed
        return view('home');
        
    }
  
}
