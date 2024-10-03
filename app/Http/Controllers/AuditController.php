<?php

namespace App\Http\Controllers;


use App\Audit;
use App\Audits;
use App\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        // $users  = User::where('role_id','!=',3)->get();
        // return view('admin.audit_trail.index',compact('users'));

        $userActivities = Audit::select(
            'users.name', 
            'users.email', 
            'users.role_id', 
            'audits.event', 
            'audits.auditable_type', 
            'audits.new_values', 
            'audits.user_agent', 
            'audits.ip_address', 
            'audits.created_at' 
        )
        ->join('users', 'audits.user_id', '=', 'users.id') 
        ->where('users.role_id', '!=', 3)
        ->get();
        
        // dd($userActivities);
        // Pass the user activity data to the view
        return view('admin.audit_trail.index', compact('userActivities'));
    }


}

