<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Prescription;
use Auth;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
    
        $bookings =  Booking::where('date',date('Y-m-d'))->where('status',1)->where('doctor_id',auth()->user()->id)->get();
		return view('prescription.index',compact('bookings'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $data  = $request->all();
    	unset($data['signature']);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('prescriptions', 'public');
            $data['file_path'] = $filePath;
        }

    	Prescription::create($data);
    	return redirect()->back()->with('message','Appointment report created');
    }

    public function show($userId, $date)
    {
        $prescription = Prescription::where('user_id', $userId)
            ->where('date', $date)
            ->where('doctor_id', auth()->user()->id) // Filter by the currently logged-in doctor's ID
            ->first();

        if ($prescription) {
            return view('prescription.show', compact('prescription'));
        } else {
            // Handle the case where prescription is not found
            return redirect()->route('prescribed.patients')->with('error', 'Prescription not found.');
        }
    }

    public function patientsFromPrescription()
    {
        
            $patients = Prescription::where('doctor_id', auth()->user()->id)->get();
            return view('prescription.all', compact('patients'));
        
        
    }

    public function viewFile($id)
    {
        $id = decrypt($id);

        $prescription = Prescription::where('id', $id)
            ->where('doctor_id', auth()->user()->id)
            ->first();
            $prescription = Prescription::findOrFail($id);

        // Check if the file exists
        if (!Storage::disk('prescriptions')->exists($prescription->file_path)) {
            abort(404);
        }

        // Get the file content
        $fileContents = Storage::disk('prescriptions')->get($prescription->file_path);

        // Determine the MIME type
        $mimeType = Storage::disk('prescriptions')->mimeType($prescription->file_path);

        // Return the file as response
        return response($fileContents, 200)->header('Content-Type', $mimeType);
    }
}
