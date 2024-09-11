<?php

use Carbon\Carbon;

?>
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="fs-3 fw-bolder text-danger text-end py-2">
        Welcome {{ strtoupper($user->name) }}!
    </div>
</div>

@if(Auth::user()->role == 'admin')
<div class="container m-auto w-50 h-75 mb-5" >
    <div class="col-12">
        <div class="card bg-white text-center d-flex justify-content-center align-items-center shadow-lg" style="background-color:#ffffff;">
            <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-2 my-2" style="height:120px; width:120px" alt="">
            <div class="card-body text-center">
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">Name :</strong> {{ ucwords($user->name) }}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">E-mail :</strong> {{$user->email}}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">User Type :</strong>{{ucwords($user->role)}}</h5>
                <h5 class="card-title py-2 "><strong class="fw-bolder pe-3">Gender :</strong> {{$user->gender}}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">Birthdate :</strong>{{$user->birthdate}}</h5>
                <a href="{{ route('users.edit',$user->id) }}" class="py-2 px-3 bg-success text-white border-0 rounded-3 my-3"> Edit your profile </a>
                <a href="{{ route('users.addAdmin') }}" class="py-2 px-3  border-0 rounded-3 my-3 text-black fw-bolder" style="background-color:#efd788;">Add New Admin</a>

            </div>
        </div>
    </div>
</div>
<!-- Profile -->

@elseif(Auth::user()->role == 'employer')
<div class="container m-auto w-50 h-75 mb-5" >
    <div class="col-12">
        <div class="card bg-white text-center d-flex justify-content-center align-items-center shadow-lg" style="background-color:#ffffff;">
            <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-2 my-2" style="height:120px; width:120px" alt="">
            <div class="card-body text-center">
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">Name :</strong> {{ ucwords($user->name) }}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">E-mail :</strong> {{$user->email}}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">User Type :</strong>{{ucwords($user->role)}}</h5>
                <h5 class="card-title py-2 "><strong class="fw-bolder pe-3">Gender :</strong> {{$user->gender}}</h5>
                <h5 class="card-title py-2"><strong class="fw-bolder pe-3">Birthdate :</strong>{{$user->birthdate}}</h5>
                <a href="{{ route('users.edit',$user->id) }}" class="py-2 px-3 bg-success text-white border-0 rounded-3 my-3"> Edit your profile </a>

            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == 'candidate')
<div class="container">
    <div class="row">
        <!--Profile-->
        <div class="col-12 col-md-4">
            <div class="card bg-white text-center d-flex justify-content-center align-items-center shadow-lg">

                <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-2 my-3" style="height:150px; width:150px" alt="">
                <div class="card-body text-start">
                    <h5 class="card-title py-2">Name: {{ ucwords($user->name) }}</h5>
                    <h5 class="card-title py-2">E-mail: {{$user->email}}</h5>
                    <h5 class="card-title py-2">User Type: {{$user->role}}</h5>
                    <h5 class="card-title py-2">Gender: {{$user->gender}}</h>
                    <h5 class="card-title py-2">Birthdate: {{$user->birthdate}}</h5>
                    <h5 class="card-title py-2">Phone: {{$user->candidate->phone}}</h5>
                    <h5 class="card-title py-2">Skills: {{$user->candidate->skills}}</h5>
                    <h5 class="card-title py-2 d-inline"> Resume: </h5>



                    
                    <?php

$counter = 1;

      ?>
         
    

  
                    @foreach($user->resumes as $r)
                    <div class='border rounded shadow p-2 m-2'>
                    <div> Resume no. {{$counter}}<a href="{{ asset('uploads/' . $r->resume) }}" class="btn btn-outline-primary ms-5" target="_blank"> View</a> </div>
                    <p class="text-muted"><small>{{$r->created_at->diffForHumans(['parts' => 1])}}</small></p>
                    </div>
                    <?php

$counter ++;

      ?>
                    @endforeach

                    @if ($user->candidate->employed == 'employed')
                    <h5 class="card-title py-2">Employment Status: {{ucwords($user->candidate->employed)}}</h5>
                    <h5 class="card-title py-2">Company: {{ucwords($user->candidate->company)}}</h5>
                    <h5 class="card-title py-2">Job Description: {{ucwords($user->candidate->job_description)}}</h5>
                    @else
                    <h5 class="card-title py-2">Employment Status: {{ucwords($user->candidate->employed)}}</h5>
                    @endif


                    <a href="{{ route('users.edit',$user->id) }}" class=" btn py-2 px-3 text-white border-0 rounded-3 my-3" style="background-color:#102C57"> Edit Profile  </a>

                </div>

            </div>
        </div>
        <!--Applications-->


        <div class="col-12 col-md-8 ">
            <div class="card bg-white shadow-lg">
                <div class="card-header bg-white ">
                    <h5 class="card-title text-center fs-3 fw-bolder text-danger pt-2">Your Applications</h5>
                </div>
                <div class="card-body">
                    @if($applications->isEmpty())
                    <p>No applications found.</p>
                    @else
                    @foreach ($applications as $application)
                    <div class="card-body">
                            @if($application->jobPost)

<h5 class="card-title fw-bolder"> <strong class="fw-bolder">Job Title : </strong> {{ $application->jobPost->job_title }}</h5>
                        <p><strong>Empolyer Name:</strong> {{ $application->jobPost->user->name }}</p>
                        <p><strong class="fw-bolder">Description:</strong> {{ $application->additional_information }}</p>
                        <p><strong class="fw-bolder">Submitted On:</strong> {{ $application->created_at->format('F j, Y') }}</p>
                        <p><strong>Status:</strong> {{ $application->status }}</p>
                       
   
                        @else
                        <p>Job information not available</p>
                        @endif
                        <div class="text-center">
                        @if($application->status =='cancelled')
                        <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @elseif ($application->status =='approved')
                        <div class="alert alert-success text-center" role="alert">
  Congratulations! You have been accepted for this job. Please wait for the employer to contact you soon.
</div>                        @else
                      
                            <a href="{{ route('applications.show' , $application->id) }}" class="btn text-white" style="background-color:#102C57">View </a>
                            <a href="{{ route('applications.edit' , $application->id) }}" class="btn text-black" style="background-color:#DAC0A3">Edit </a>
                            <a href="{{ route('applications.cancel' , $application->id) }}" class="btn text-white" style="background-color:maroon">Cancel </a>

                            @endif
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif
                </div>

                <tr>

                    <td>
                        @if(!$applications->isEmpty())

                    </td>

                </tr>


              
                <div class="pagination justify-content-center mt-4">
    {{ $applications->links('pagination::bootstrap-4') }}
</div>
                @endif
            </div>
        </div>
    </div>


</div>

@endIf
@endsection

