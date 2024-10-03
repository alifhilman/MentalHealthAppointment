@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(Auth::guest())
    <div class="row">
        <div class="col-md-1"></div> <!-- Empty column for space -->
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h2 class="mb-3 display-4"><strong>Welcome To Tranquil Minds</strong></h2>
            <h3 class="text-justify mb-3 font-size-lg"> Take the first step towards better mental health with TranquilMinds. Our platform provides a seamless experience for booking mental health assessment appointments. Whether you're seeking support for anxiety, depression, or other mental health concerns, we're here to help you find the right care. </h3>
            <div class="mt-6">
                <a href="{{ url('/register_therapist') }}">
                    <button class="btn btn-success btn-sm" style="background-color: #1B3D2F;">Register as Therapist</button>
                </a><br>
                <a href="{{ url('/register') }}">
                    <button class="btn btn-success btn-sm" style="background-color: #1B3D2F;">Register as Patient</button>
                </a>
                <a href="{{ url('/login') }}">
                    <button class="btn btn-secondary btn-sm">Login</button>
                </a>
            </div>
        </div>
        <div>
            <img src="/banner/hoho.png" >
        </div>
    </div>
    @endif

    @auth
    <!-- Search therapist -->
    <form action="{{ url('/') }}" method="GET" style="outline: none;">
        <div class="card border-0">
            <div class="card-body">
                <div class="badge badge-pill badge-light" style="font-size: 20px;">Find Therapists</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="date" class="form-control" id="datepicker" placeholder="Select Date">
                            <br>
                        </div>
                        <div class="col-md-8">
                            <button class="btn btn-primary btn-secondary" type="submit" style="background-color: #1ed1d5;">Find Therapists</button>
                        </div>
                    </div>
                </div>
                <!-- Display therapists -->
                <div class="badge badge-pill badge-light mt-3" style="font-size: 20px;">List of Therapists Available</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Expertise/Specialty</th>
                                <th>Book</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $doctor)
                            <tr>
                                <td scope="row"></td>
                                <td>{{ $doctor->doctor->name ?? 'N/A' }}</td> <!-- Use null coalescing operator to handle null case -->
                                <td>
                                    <img src="{{ asset('images') }}/{{ $doctor->doctor->image ?? 'default.jpg' }}" width="100px" style="border-radius: 50%;">
                                </td>
                                <td>{{ $doctor->doctor->department ?? 'N/A' }}</td> <!-- Use null coalescing operator to handle null case -->
                                <td>
                                    <a href="{{ route('create.appointment', [$doctor->user_id, $doctor->date]) }}"
                                        <button class="btn btn-success btn-sm" style="background-color: #1ed1d5;">Book Appointment</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    </div>
    @endauth
</div>
@endsection

@if(Auth::guest())
@section('footer')
<footer class="text-center py-4" style="background-color: rgb(14, 9, 96); background: linear-gradient(90deg, rgba(14, 9, 96, 1) 0%, rgba(30, 209, 213, 0.6287128712871287) 0%, rgba(19, 127, 142, 1) 0%, rgba(22, 148, 160, 1) 75%); display: flex; justify-content: space-around;">
    <p>&copy; {{ date('Y') }} TranquilMinds. All Rights Reserved.</p>
    <p>Email: tranquilminds@gmail.com</p>
    <p>Contact Number: +03-6046-8085</p>
</footer>
@endsection
@endif

<style>
    /* Custom styles */
    body {
        background-color: #f8f9fa;
    }

    .card-custom {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .badge-custom {
        background-color: #6c757d;
        color: #fff;
        font-size: 1.2rem;
        padding: 8px 15px;
        border-radius: 20px;
    }

    .btn-custom {
        background-color: #1ed1d5;
        border-color: #1ed1d5;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 1rem;
    }

    .btn-custom:hover {
        background-color: #15a29e;
        border-color: #15a29e;
    }

    footer {
        background-color: #1B3D2F;
        color: #fff;
        padding: 5px 0;
    }
</style>