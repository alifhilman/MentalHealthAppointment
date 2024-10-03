@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Initial dashboard message -->
    <div id="dashboard-message" class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are logged in as {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>

    <script>
    // Wait for 2 seconds before redirecting
    setTimeout(function() {
        window.location.href = "{{ url('/') }}"; // Redirect to the welcome page
    }, 2000); // 2000 milliseconds = 2 seconds
</script>
@endsection
