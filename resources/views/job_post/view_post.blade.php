@extends('layouts.app')

@section('content')





@php
$required_skills = explode(" ", $jobPost->required_skills);
$posted_from = $jobPost->created_at->diffForHumans(['parts' => 1]);
@endphp

<div class="container mt-5">
@if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif
    <div class="card mb-3 shadow-lg" style="background-color:#ffffff">
        <div class="row g-0">
            <div class="col w-75">
                <div class="card-body d-flex justify-content-around">
                    <div class="pt-3">
                        <span class="card-title"><strong class="pe-2">Employer Name:</strong>{{ $jobPost->user->name}}</span>
                    </div>
                    <div class="pt-3">
                        <span class="card-text"><strong class="pe-2">Email: </strong>{{ $jobPost->user->email}}</span>
                    </div>
                    <div>
                        @if($jobPost->user->image == null)
                        <img src="{{asset('images/user.png')}}" class="img-fluid rounded-circle" style="height: 50px; width:50px;" alt="Emplyer Image">
                        @else
                        <img src="{{ asset('uploads/' . $jobPost->user->image) }}" class="img-fluid rounded-circle" height="100" width="100" alt="Employer Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="container my-5 d-flex justify-content-center shadow-lg rounded-3">

    <div class="row g-0">
        <div class="card my-3 ">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="{{ asset('uploads/' . $jobPost->image) }}" class="img-fluid rounded-start" alt="{{ $jobPost->image }}">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title"><strong class="pe-2 py-2">Job title :</strong>{{ $jobPost->job_title }}</h5>
                        <p class="card-subtitle mb-2 text-muted">
                        <h5 class="d-inline pe-2 py-2"><strong>Description :</strong>{{ $jobPost->description }}</p>
                            <p class="card-text">
                                @foreach ($required_skills as $required_skill)
                                <span class="badge text-bg-secondary fs-6">{{ $required_skill }}</span>
                                @endforeach
                            </p>
                            <p class="card-text">
                                <span class="job-type m-2"><i class="fas fa-clock"></i> {{ $jobPost->work_type }}</span>
                                <span class="job-type m-2"><i class="fas fa-building"></i> {{ $jobPost->work_from }}</span>
                                <span class="job-location m-2"><i class="fas fa-map-marker-alt"></i> {{ $jobPost->location }}</span>
                            </p>
                            <span class="job-type m-2"><strong class="pe-2 py-2">Posted:</strong>{{ $posted_from }}</span></p>
                            <p class="card-subtitle mb-2 text-muted">
                                <span class="job-type m-2"><strong class="pe-2 py-2">Budged:</strong> $ {{ $jobPost->s_from }}</span> -
                                <span class="job-type m-2">$ {{ $jobPost->s_to }}</span>
                            </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm my-3">
            <div class="card-body text-center">
                <h4>Comments</h4>
                <form action="{{route('comments.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        @error('comment')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="comment">Add a Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>

                        <input type="hidden" value="{{$jobPost->id}}" name="commentable_id">

                    </div>
                    <button type="submit" class="btn mt-2" style="background-color:#102C57; color: #ffffff;">Submit</button>
                </form>

                <div class="mt-4">
                    @if($jobPost->comments->count())
                    <ul class="list-group list-group-flush">
                        @foreach($jobPost->comments as $comment)
                        <li class="list-group-item d-flex align-items-start">
                            @if($jobPost->user->image == null)


                            <img src="{{asset('images/user.png')}}" class="rounded-circle me-3" alt="User IMage " style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <img src="{{ asset('uploads/' . $comment->user->image) }}" class="rounded-circle me-3" alt="User IMage " style="width: 50px; height: 50px; object-fit: cover;">
                            @endif
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="my-2">{{ $comment->body }}</p>


                                <div class="d-flex justify-content-end">

                                    @if ($comment->user->id == Auth::user()->id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background-color:maroon; color:white">Delete</button>
                                    </form>
                                    @elseif (Auth::user()->role== 'admin' && $comment->user->id != Auth::user()->id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete (not yours)</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>
                    @else
                    <p>No comments yet. Be the first to comment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection