@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All Appointments ({{$patients->count()}})
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Gender</th>
                                
                                <th scope="col">Therapist</th>
                                <th scope="col">Appointment Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patients as $key => $patient)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td><img src="/profile/{{$patient->user->image}}" width="80" style="border-radius: 50%;"></td>
                                <td>{{$patient->created_at}}</td>
                                <td>{{$patient->user->name}}</td>
                                <td>{{$patient->user->email}}</td>
                                <td>{{$patient->user->phone_number}}</td>
                                <td>{{$patient->user->gender}}</td>
                                <td>{{$patient->doctor->name}}</td>
                                <td>
                                    @if($patient instanceof \App\Booking)
                                        @if(!App\Prescription::where('user_id', $patient->user_id)->where('date', $patient->date)->exists())
                                            <button class="btn btn-secondary" disabled>View Appointment Report</button>
                                        @else
                                            <a href="{{route('prescription.show', [$patient->user_id, $patient->date])}}" class="btn btn-secondary">View Appointment Report</a>
                                        @endif
                                    @else
                                        <a href="{{route('prescription.show', [$patient->user_id, $patient->date])}}" class="btn btn-secondary">View Appointment Report</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">There are no appointments!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
