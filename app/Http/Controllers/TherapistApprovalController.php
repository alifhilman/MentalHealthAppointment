<?php

namespace App\Http\Controllers;

use App\Mail\TherapistApprovalMail;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TherapistApprovalController extends Controller
{
    // Display the list of doctors pending approval
    public function index()
    {
        $doctors = User::where('role_id', Role::where('name', 'doctor')->first()->id)
                       ->where('status', 'pending_approval')
                       ->get();
                      
        return view('admin.approval.index', compact('doctors'));
    }

    // Approve a doctor
    public function approve($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->status = 'approved';
        $doctor->save();

        // Send approval email
        Mail::to($doctor->email)->send(new TherapistApprovalMail($doctor));

        return redirect()->route('therapists.index')->with('success', 'Therapist approved successfully');
    }

    // Reject a doctor
    public function reject($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->status = 'rejected';
        $doctor->save();

        return redirect()->route('therapists.index')->with('success', 'Therapist rejected successfully');
    }
}
