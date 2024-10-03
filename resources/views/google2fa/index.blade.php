@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold" style="font-size: 24px;">
                    Register
                </div>
                <hr>
                @if($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                          <strong>{{ $errors->first() }}</strong>
                        </div>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('2fa') }}">
                        @csrf

                        <div class="form-group">
                            <p class="text-center" style="font-size: 18px;">
                                Please enter the <strong>OTP</strong> generated on your Authenticator App. <br>
                                Ensure you submit the current one because it refreshes every 30 seconds.
                            </p>
                            <label for="one_time_password" class="col-form-label text-md-right" style="font-size: 18px;">One Time Password</label>

                            <div>
                                <input id="one_time_password" type="number" class="form-control form-control-lg" name="one_time_password" required autofocus>
                            </div>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
