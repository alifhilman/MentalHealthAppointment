@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Appointment Report Details
                </div>
                <div class="card-body">
                    <!-- Display other prescription details here -->
                    @if($prescription->file_path)
                        @if(strpos($prescription->file_path, '.pdf') !== false)
                        <embed src="{{ Storage::url($prescription->file_path) }}" width="100%" height="600px" type="application/pdf">

                        @else
                            <img src="{{ asset('storage/' . $prescription->file_path) }}" class="img-fluid" alt="Prescription File">
                        @endif
                        <p><a href="{{ Storage::url($prescription->file_path) }}" target="_blank">View File</a></p>

                    @else
                        <p>No file uploaded.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
