@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Appointment Report</div>

                <div class="card-body">
                 
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          
                          <th scope="col">Date</th>
                          <th scope="col">Therapist</th>
                          <th scope="col">Therapist Feedback</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($prescriptions as $prescription)
                        <tr>
                         
                          <td>{{$prescription->date}}</td>
                          <td>{{$prescription->doctor->name}}</td>
                          <td><a href="{{ Storage::url($prescription->file_path) }}" target="_blank" class="btn btn-success btn-sm">View Appointment Report</a></td>
                        </tr>
                        @empty
                        <td>You have no prescriptions</td>
                        @endforelse
                       
                      </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
