@extends('admin.layouts.master')

@section('content')

<style>
    .multiline {
        white-space: pre-line !important; /* This allows newline characters to create line breaks */
    }
</style>

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Audit Trail</h5>
                    <span>List of all TranquilMinds User's Activities</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Audit Trail</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center">
                <h3>List of User's Activities</h3>
                <hr>
            </div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Event</th>
                            <th>Event at</th>
                            <th>Activities</th>
                            <th>Hardware Use</th>
                            <th>IP Address</th>
                            <th>Created at</th>
                            <th class="nosort" ></th>
                            <th class="nosort" ></th>
                            
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userActivities as $userActivity)
                        <tr>
                            <td>{{ $userActivity->name }}</td>
                            <td>{{ $userActivity->email }}</td>
                            <td>{{ $userActivity->role_id }}</td>
                            <td>{{ $userActivity->event }}</td>
                            <td>{{ $userActivity->auditable_type }}</td>
                            <td class="multiline">
                                @foreach(json_decode($userActivity->new_values) as $key => $value)
                                    {{ $key }}: {{ $value }}<br>
                                @endforeach
                            </td>
                            <td>{{ $userActivity->user_agent }}</td>
                            <td>{{ $userActivity->ip_address }}</td>
                            <td>{{ $userActivity->created_at }}</td>
                            <th class="nosort" ></th>
                            <th class="nosort" ></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
