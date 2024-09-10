<?php

use Carbon\Carbon;

?>


@extends('layouts.app')


@section('content')
<div class ="container">
@if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif
</div>  

@foreach ($jobPosts as $jobPost)

<?php



$required_skills =explode(" ", $jobPost->required_skills);
$posted_from = $jobPost->created_at->diffForHumans(['parts' => 1]);


?>

<div class="container mt-5">




    <div class="card mb-3" >
      <div class="row g-0 ">

        <div class="col-md-3">
          <img src="{{ asset('uploads/'.$jobPost->image) }}" class="img-fluid rounded-start" alt="{{$jobPost->image}}">
        </div>
        
        <div class="col-md-9">
          <div class="card-body">
          <h5 class="card-title">{{$jobPost->job_title}}</h5>
                
                <p class="card-subtitle mb-2 text-muted">{{$jobPost->description}}</p>
                <p class="card-text">
                    @foreach ($required_skills as $required_skill)
                        <span class="badge text-bg-secondary fs-6">{{$required_skill}}</span>
                    @endforeach
                </p>
                <p class="card-text">
                    <span class="job-type m-2"><i class="fas fa-clock"></i> {{$jobPost->work_type}}</span>
                    <span class="job-type m-2"><i class="fa-solid fa-building"></i> {{$jobPost->work_from}}</span>
                    <span class="job-location m-2"><i class="fas fa-map-marker-alt"></i> {{$jobPost->location}}</span>
        
                </p>

                <p class="card-subtitle mb-2 text-muted">
                    <strong>Budged</strong><span class="job-type m-2">$ {{$jobPost->s_from}}</span>-
                    <span class="job-type m-2">$ {{$jobPost->s_to}}</span>
<br>
                    <strong>Posted</strong> <span class="job-type m-2">{{$posted_from}}</span>

                </p>

                <p class="card-subtitle mb-2 text-muted">
     
                    <strong>Number of Applications: </strong> <span class="job-type m-2">{{$jobPost->applications->count()}}</span>

                </p>

                <p class="card-subtitle mb-2 text-muted">
                    @if($user->role== "employer")
                        <strong>Status</strong><span class="job-type m-2">{{$jobPost->status}}</span>
                    @endif
                    <br>
                                        <strong>User Name</strong><span class="job-type m-2">{{$jobPost->user->name}}</span>                    
                </p>

                
                

                <a href="{{ route('job_posts.show',$jobPost->id) }}" class="card-link btn btn-outline-primary">View Details</a>
                
                @if($user->role== "candidate")
                    <a href="{{ route('application.add' , $jobPost->id) }}" class="card-link">Apply Now</a>
                @endif
                @if($user->role== "employer")
                <form action="{{ route('job_posts.destroy' , $jobPost->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>

                            <a href="{{ route('job_posts.edit' , $jobPost->id) }}" class="btn btn-outline-success">Edit</a>


                @endif
                
               

          </div>
        </div>

      </div>
    </div>
</div>






@endforeach

<div class="pagination justify-content-center mt-4">
    {{ $jobPosts->links('pagination::bootstrap-4') }}
</div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
