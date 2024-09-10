<?php

use Carbon\Carbon;

?>


@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <p>Welcome, Admin!</p>
                        <a href="{{ route('admin.posts') }}" class="btn btn-primary">Manage Job Posts</a>
                    @elseif (auth()->check() && auth()->user()->role === 'employer')
                        <p>Welcome, Employer!</p>
                        <a href="{{ route('job_posts.index') }}" class="btn btn-primary">Manage Job Posts</a>
                    @else
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> -->

<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>



@foreach ($jobPosts as $jobPost)

<?php



// dd($user->role)
// dd($jobPost->user_id)

$required_skills =explode(" ", $jobPost->required_skills);
$posted_from = $jobPost->created_at->diffForHumans(['parts' => 1]);
// $posted_from = Carbon::create(2024, 9, 8, 0, 0, 0, 'America/Toronto')->diffForHumans(['parts' => 1]);


?>

<div class="container mt-5">

    <div class="card mb-3" >
      <div class="row g-0 ">

        <div class="col-md-3">
          <img src="{{$jobPost->image}}" class="img-fluid rounded-start" alt="{{$jobPost->image}}">
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
                    <!-- <span class="badge badge-secondary">Remote</span> -->
                    <!-- <span class="badge badge-info">Full-Time</span> -->
                </p>

                Posted <span class="job-type m-2">{{$posted_from}}</span>
                <p class="card-subtitle mb-2 text-muted">
                    Budged<span class="job-type m-2">$ {{$jobPost->s_from}}</span>-
                    <span class="job-type m-2">$ {{$jobPost->s_to}}</span>
                </p>

                <p class="card-subtitle mb-2 text-muted">
                    @if($user->role== "employer")
                        Status<span class="job-type m-2">{{$jobPost->status}}</span>
                    @endif
                    User Name<span class="job-type m-2">{{$jobPost->user->name}}</span>                    
                </p>

                
                


                @if($jobPost->status == "pended")

                    <form action="{{ route('job_posts.approve', $jobPost->id) }}" method="POST" style="display:inline;">
                        @csrf
                        
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('job_posts.cancel', $jobPost->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>

                    
                    
                @endif
               
                @if($jobPost->status == "canceled")
                <form action="{{ route('job_posts.destroy' , $jobPost->id) }}" method="post"  class="card-link">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger card-link">Delete</button>

                </form>
                @endif


          </div>
        </div>

      </div>
    </div>
</div>






@endforeach





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
