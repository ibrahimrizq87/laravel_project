@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Job Posts</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($jobPosts->isEmpty())
            <p>No job posts available.</p>
        @else
            <div class="row">
                @foreach ($jobPosts as $jobPost)
                    <div class="col-md-4 mb-4">
                        <div class="card job-card">
                            <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Job Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $jobPost->job_title }}</h5>
                                <p class="card-text">
                                    <strong>Description:</strong> {{ Str::limit($jobPost->description, 100) }}<br>
                                    <strong>Location:</strong> {{ $jobPost->location }}<br>
                                    <strong>Salary Range:</strong> {{ $jobPost->salary_range }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('job_posts.edit', $jobPost->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('job_posts.destroy', $jobPost->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <small>Posted on {{ $jobPost->created_at->format('d M, Y') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('job_posts.create') }}" class="btn btn-success mt-4">Create New Job Post</a>
    </div>
@endsection

@section('styles')
    <style>
        .job-card {
            transition: transform 0.3s ease;
        }
        .job-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
@endsection
