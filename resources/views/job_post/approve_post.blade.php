<?php

use Carbon\Carbon;

?>


@extends('layouts.app')

@section('content')


@foreach ($jobPosts as $jobPost)

<?php



// dd($user->role)
// dd($jobPost->user_id)

$required_skills =explode(" ", $jobPost->required_skills);
$posted_from = $jobPost->created_at->diffForHumans(['parts' => 1]);
// $posted_from = Carbon::create(2024, 9, 8, 0, 0, 0, 'America/Toronto')->diffForHumans(['parts' => 1]);


?>

<div class="container mt-5">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ asset('uploads/'.$jobPost->image) }}" class="img-fluid rounded-start" alt="{{$jobPost->image}}">
                <div class="card-body">
                    <h5 class="card-title"><strong class="pe-2 py-2">Job title :</strong>{{$jobPost->job_title}}</h5>

                    <p class="card-subtitle mb-2 text-muted">
                        <h5 class="d-inline pe-2 py-2"><strong>Description :</strong></h5>{{$jobPost->description}}
                    </p>
                    <p class="card-text">
                        @foreach ($required_skills as $required_skill)
                        <span class="badge fs-6" style="background-color:#f5e6b4; color:black">{{$required_skill}}</span>
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
                        <span class="job-type m-2"><strong class="pe-2 py-2">Employer:</strong>{{$jobPost->user->name}}</span>
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
                    <form action="{{ route('job_posts.destroy' , $jobPost->id) }}" method="post" class="card-link">
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


<div class="pagination justify-content-center mt-4">
    {{ $jobPosts->links('pagination::bootstrap-4') }}
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
