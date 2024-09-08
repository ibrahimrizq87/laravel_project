@extends('layouts.app')

@section('content')

<div class="container">
    <div class="fs-2 fw-bolder text-danger text-end py-5">
        Welcome {{ strtoupper($user->name) }}!
    </div>
</div>

@if(Auth::user()->role == 'admin')
<div class="container">
    hey!
</div>
<!-- Profile -->

@elseif(Auth::user()->role == 'employer')
<div class="container">
   
</div>


<h1> hi </h1>
@elseif(Auth::user()->role == 'candidate')
<div class="container">
    <div class="row">
        <!--Profile-->
        <div class="col-12 col-md-4">
            <div class="card bg-white text-center d-flex justify-content-center align-items-center ">

                <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-3 " style="height:150px; width:150px" alt="">
                <div class="card-body text-start">
                    <h5 class="card-title py-3">Name: {{ ucwords($user->name) }}</h5>
                    <h5 class="card-title py-3">E-mail: {{$user->email}}</h5>
                    <h5 class="card-title py-3">User Type: {{$user->role}}</h5>
                    <h5 class="card-title py-3">Gender: {{$user->gender}}</h>
                    <h5 class="card-title py-3">Birthdate: {{$user->birthdate}}</h5>
                    

                    <button class="py-2 px-3 bg-success text-white border-0 rounded-3 my-3"> Edit your profile </button>

                </div>

            </div>
        </div>
        <!--Applications-->

        @if($user->role == 'candidate')
        <div class="col-12 col-md-8">
            <div class="card bg-white">
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
                        <h5 class="card-title fw-bolder"> <strong>Job Title : </strong> {{ $application->jobPost->job_title }}</h5>
                        <p><strong>Description:</strong> {{ $application->additional_information }}</p>
                        <p><strong>Submitted On:</strong> {{ $application->created_at->format('F j, Y') }}</p>
                        @else
                        <p>Job information not available</p>
                        @endif
                        <div class="text-center">
                            <button class="btn bg-success text-white">View </button>
                            <button class="btn bg-warning text-black">Edit </button>
                            <button class="btn bg-danger text-white">Cancel </button>

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


                <!-- Pagination Controls -->
                <div class="pagination">
                    {{ $applications->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>
@endIf
@endsection