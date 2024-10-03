<?php

// app/Http/Middleware/ApprovedTherapist.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApprovedTherapist
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->name === 'doctor') {
            if (Auth::user()->status === 'pending_approval') {
                auth()->logout();
                return redirect()->route('auth.approval_required');
            } elseif (Auth::user()->status === 'rejected') {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your application has been rejected. Please contact support for further details.');
            }
        }

        return $next($request);
    }
}
