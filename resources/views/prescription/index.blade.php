@extends('admin.layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
                @endif
                <div class="card-header">
                    Appointment ({{ $bookings->count() }})
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Time</th>
                                <th scope="col">Therapist</th>
                                <th scope="col">Status</th>
                                <th scope="col">Appointment Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $key => $booking)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><img src="/profile/{{ $booking->user->image }}" width="80" style="border-radius: 50%;"></td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->user->email }}</td>
                                <td>{{ $booking->user->phone_number }}</td>
                                <td>{{ $booking->user->gender }}</td>
                                <td>{{ $booking->time }}</td>
                                <td>{{ $booking->doctor->name }}</td>
                                <td>@if($booking->status == 1) Visited @endif</td>
                                <td>
                                    @if(!App\Prescription::where('date', date('Y-m-d'))->where('doctor_id', auth()->user()->id)->where('user_id', $booking->user->id)->exists())
                                    <form method="POST" action="{{ route('prescription') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
                                        <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload Report</button>
                                    </form>
                                    @else
                                    @if($booking->prescription)
                                    <a href="{{ route('prescription.file', Crypt::encryptString($booking->prescription->id)) }}" class="btn btn-secondary">View Appointment Report</a>
                                    @else
                                    <a href="{{route('prescription.show', [$booking->user_id, $booking->date])}}" class="btn btn-secondary">View Appointment Report</a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11">There are no appointments!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
