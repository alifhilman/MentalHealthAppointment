@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card card-default">
                <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>
   
                <div class="card-body" style="text-align: center;">
                    <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code <strong>{{ $secret }}</strong></p>
                    <div>
                        {!! $QR_Image !!}
                    </div>
                    <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                    <div>
                        @if (request()->routeIs('register.therapist'))
                            <a href="{{ route('complete.therapist.registration') }}" class="btn btn-primary">Complete Registration</a>
                        @else
                            <a href="{{ route('complete.registration') }}" class="btn btn-primary">Complete Registration</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
