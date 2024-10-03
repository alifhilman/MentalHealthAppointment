@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 d-flex flex-column justify-content-center text-center bg-light p-5 rounded shadow">
        <h2 class="mb-3 display-4"><strong>Thankyou registered as one of the Therapist at Tranquil Minds</strong></h2>
        <p class="mb-3 font-size-lg">Your registration as a therapist is pending and will be reviewed for the authentication of the certification.</p>
        <p class="mb-3 font-size-lg">You will receive an email notification once your registration has been approved.</p>
        <p class="mb-3 font-size-lg">Thank you for your patience.</p>

                <a href="{{ url('/') }}">
                    <button class="btn btn-secondary btn-sm">Go Back To HomePage</button>
                </a>
    </div>
</div>
@endsection
