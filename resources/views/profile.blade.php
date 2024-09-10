@extends('layouts.app')

@section('content')

<div class="container">
    <div class="fs-2 fw-bolder text-danger text-end py-3">
        Welcome {{ strtoupper($user->name) }}!
    </div>
</div>

@if(Auth::user()->role == 'admin')
<div class="container m-auto w-50 h-75">
    <div class="col-12">
        <div class="card bg-white text-center d-flex justify-content-center align-items-center">
            <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-2 my-3" style="height:120px; width:120px" alt="">
            <div class="card-body text-center">
                <h5 class="card-title py-3">Name : {{ ucwords($user->name) }}</h5>
                <h5 class="card-title py-3">E-mail : {{$user->email}}</h5>
                <h5 class="card-title py-3">User Type :{{ucwords($user->role)}}</h5>
                <h5 class="card-title py-3 ">Gender : {{$user->gender}}</h5>
                <h5 class="card-title py-3">Birthdate :{{$user->birthdate}}</h5>
                <button class="py-2 px-3 bg-success text-white border-0 rounded-3 my-3"> Edit your profile </button>
                <button class="btn bg-success text-white">Add New Admin</button>
            </div>
        </div>
    </div>
</div>
<!-- Profile -->

@elseif(Auth::user()->role == 'employer')
<div class="container m-auto w-50 h-75">
    <div class="col-12">
        <div class="card bg-white text-center d-flex justify-content-center align-items-center">
            <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="rounded-circle py-2 my-2" style="height:120px; width:120px" alt="">
            <div class="card-body text-center">
                <h5 class="card-title py-2">Name : {{ ucwords($user->name) }}</h5>
                <h5 class="card-title py-2">E-mail : {{$user->email}}</h5>
                <h5 class="card-title py-2">User Type :{{ucwords($user->role)}}</h5>
                <h5 class="card-title py-2 ">Gender : {{$user->gender}}</h5>
                <h5 class="card-title py-2">Birthdate :{{$user->birthdate}}</h5>
                <button class="py-2 px-3 bg-success text-white border-0 rounded-3 my-3"> Edit your profile </button>
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
                    @foreach($user->resumes as $r)
                    <h5 class="card-title py-2 d-inline"> Resume:<a href="{{ asset('uploads/CVs/' . $r->resume) }}" target="_blank"> {{$r->resume}}</a> </h5>

                    @endforeach

                    @if ($user->candidate->employed == 'employed')
                    <h5 class="card-title py-2">Employment Status: {{ucwords($user->candidate->employed)}}</h5>
                    <h5 class="card-title py-2">Company: {{ucwords($user->candidate->company)}}</h5>
                    <h5 class="card-title py-2">Job Description: {{ucwords($user->candidate->job_description)}}</h5>
                    @else
                    <h5 class="card-title py-2">Employment Status: {{ucwords($user->candidate->employed)}}</h5>
                    @endif


                    <button class=" btn py-2 px-3 text-white border-0 rounded-3 my-3" style="background-color:#102C57"> Edit Profile </>

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
                        <h5 class="card-title fw-bolder"> <strong>Job Title : </strong> {{ $application->jobPost->job_title }}</h5>
                        <p><strong>Description:</strong> {{ $application->additional_information }}</p>
                        <p><strong>Submitted On:</strong> {{ $application->created_at->format('F j, Y') }}</p>
                        @else
                        <p>Job information not available</p>
                        @endif
                        <div class="text-center">
                            <button class="btn text-white" style="background-color:#102C57">View </button>
                            <button class="btn text-black" style="background-color:#DAC0A3">Edit </button>
                            <button class="btn text-white" style="background-color:maroon">Cancel </button>

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


</div>
@endIf
@endsection

