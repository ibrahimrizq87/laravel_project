<?php

use Carbon\Carbon;

?>


@extends('layouts.app')

@section('content')


<div class="container my-5">
    <div class="row g-3">
        @foreach ($jobPosts as $jobPost)

        <?php
        // dd($user->role)
        // dd($jobPost->user_id)

        $required_skills = explode(" ", $jobPost->required_skills);
        $posted_from = $jobPost->created_at->diffForHumans(['parts' => 1]);
        // $posted_from = Carbon::create(2024, 9, 8, 0, 0, 0, 'America/Toronto')->diffForHumans(['parts' => 1]);
        ?>
        <div class="col-md-4">
            <div class="card mb-3 h-100 w-100" >
                <img src="{{ asset('uploads/'.$jobPost->image) }}" class="card-img-top img-fluid" alt="{{$jobPost->image}}">
                <div class="card-body">
                    <h5 class="card-title card-text text-truncate"><strong class="pe-2 py-2">Job title :</strong>{{$jobPost->job_title}}</h5>

                    <p class="card-subtitle mb-2 text-muted card-text ">
                    <h5 class="d-inline pe-2 py-2"><strong>Description :</strong></h5>{{Str::limit($jobPost->description,100)}}
                    </p>
                    <p class="card-text">
                        @foreach ($required_skills as $required_skill)
                        <span class="badge fs-6" style="background-color:#f5e6b4; color:black;">{{$required_skill}}</span>
                        @endforeach
                    </p>
                    <p class="card-text">
                        <span class="job-type m-2"><i class="fas fa-clock"></i> {{$jobPost->work_type}}</span>
                        <span class="job-type m-2"><i class="fa-solid fa-building"></i> {{$jobPost->work_from}}</span>
                        <span class="job-location m-2"><i class="fas fa-map-marker-alt"></i> {{$jobPost->location}}</span>
                    </p>
                    <span class="job-type m-2"><strong class="pe-2 py-2">Posted:</strong>{{$posted_from}}</span>
                    <p class="card-subtitle mb-2 text-muted">
                        <span class="job-type m-2"><strong class="pe-2 py-2">Budget:</strong>$ {{$jobPost->s_from}}</span>-
                        <span class="job-type m-2">$ {{$jobPost->s_to}}</span>
                    </p>
                    <p class="card-subtitle mb-2 text-muted">
                        @if($user->role == "employer")
                        <span class="job-type m-2"><strong class="pe-2 py-2">Status:</strong>{{$jobPost->status}}</span>
                        @endif
                        <span class="job-type m-2"><strong class="pe-2 py-2">Employer:</strong>{{ucwords($jobPost->user->name)}}</span>
                    </p>


                    <div class="text-center">
                        <a href="{{ route('job_posts.show',$jobPost->id) }}" class="card-link btn" style="background-color:#102C57; color:#ffffff">View Details</a>
                    </div>

                    @if($user->role== "candidate")
                    <a href="{{ route('application.add' , $jobPost->id) }}" class="card-link" style="background-color:#102C57; color:#ffffff">Apply Now</a>
                    @endif



                </div>
            </div>

        </div>
        @endforeach
    </div>
    <div class="pagination justify-content-center my-4">
    {{ $jobPosts->links('pagination::bootstrap-5') }}
</div>
</div>













<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection