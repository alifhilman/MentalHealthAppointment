@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    <p>Name: {{ $doctor->name }}</p>
                    <p>Email: {{ $doctor->email }}</p>
                    <p>Address: {{ $doctor->address }}</p>
                    <p>Phone Number: {{ $doctor->phone_number }}</p>
                    <p>Gender: {{ $doctor->gender }}</p>
                    <p>Bio: {{ $doctor->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form action="{{ route('doctor.profile.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $doctor->name }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $doctor->address }}">
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ $doctor->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="male" @if($doctor->gender === 'male') selected @endif>Male</option>
                                <option value="female" @if($doctor->gender === 'female') selected @endif>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="description" class="form-control">{{ $doctor->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Update Image</div>
                <form action="{{ route('doctor.profile.pic') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($doctor->image)
                            <img src="{{ asset('profile/' . $doctor->image) }}" width="120">
                        @else
                            <img src="/images/default_profile_image.jpg" width="120">
                        @endif
                        <br>
                        <input type="file" name="file" class="form-control" required="">
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
