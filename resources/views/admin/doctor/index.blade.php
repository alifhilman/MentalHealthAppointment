@extends('admin.layouts.master')

@section('content')

<div class="page-header">
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-inbox bg-blue"></i>
            <div class="d-inline">
                <h5>Therapist</h5>
                <span>List of all Therapist</span>
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
                    <a >Therapist</a>
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
                {{Session::get('message')}}
            </div>
        @endif
    <div class="card">
        <div class="card-header" style ='display: flex;flex-direction: row;justify-content: space-between;align-items: center' ><h3>List of Tranquil Therapist</h3><hr>
        <a href="/doctor/create" class="btn btn-primary btn-lg active disp" role="button" aria-pressed="true">Add new Therapist</a>
    </div>

        <div class="card-body">
            <table id="data_table" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="nosort">Avatar</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone number</th>
                        <th>Specialty</th>
                        <th>Password</th> 
                        <th class="nosort"></th>
                       
                        
                        
                    </tr>
                </thead>
                <tbody>
                    @if(count($users)>0)
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td><img src="{{asset('images')}}/{{$user->image}}" class="table-user-thumb" alt=""></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->department}}</td>
                        <td class="nosort" >{{$user->password}}</td>
                        
                        
                        <td>
                            <div class="table-actions">
                            
                                <a href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}">
                                <i class="ik ik-eye"></i>
                                
                                <a href="{{route('doctor.edit',[$user->id])}}"><i class="ik ik-edit-2"></i></a>
                                
                                <a href="{{route('doctor.show',[$user->id])}}">
                                    <i class="ik ik-trash-2"></i>
                                

                            </div>
                        </td>
                        

                    </tr>
           
                    <!-- View Modal -->
                    @include('admin.doctor.model')



                    @endforeach
                   
                    @else 
                    <td>No user to display</td>
                    @endif
                
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection