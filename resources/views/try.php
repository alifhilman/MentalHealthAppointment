@extends('layouts.app')

@section('content')
<div class="container-sm">
@if(Auth::guest())
<div class="row">
    <div class="col-md-6">
        <img src="/banner/welcome_logo.jpg" class="img-fluid" style="border:1px solid #ccc;">
    </div>
    <div class="col-md-6">
        <h2>Create an account & Book your appointment</h2>
        <h3 class="text-justify"> Take the first step towards better mental health with TranquilMinds. Our platform provides a seamless experience for booking mental health assessment appointments. 
            Whether you're seeking support for anxiety, depression, or other mental health concerns, we're here to help you find the right care. </h3>
        <div class="mt-5">
            <a href="{{url('/register')}}"><button class="btn btn-success" style="background-color: #1ed1d5;">Register as Patient</button></a>
            <a href="{{url('/login')}}"><button class="btn btn-secondary">Login</button></a>
        </div>
    </div>
</div>
@endif

    @auth
    <!-- Search therapist -->
    <form action="{{url('/')}}" method="GET" style="outline: none;">
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
                            @forelse($doctors as $doctor)
                            <tr>
                                <td scope="row"></td>
                                <td>{{$doctor->doctor->name}}</td>
                                <td>
                                    <img src="{{asset('images')}}/{{$doctor->doctor->image}}" width="100px" style="border-radius: 50%;">
                                </td>
                                
                                <td>{{$doctor->doctor->department}}</td>
                                <td>
                                    <a href="{{ route('create.appointment', [$doctor->user_id, $doctor->date]) }} " 
                                    <button class="btn btn-success btn-sm" style="background-color: #1ed1d5;">Book Appointment</button>  
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No therapists available today</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endauth
@endsection

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
</style>
