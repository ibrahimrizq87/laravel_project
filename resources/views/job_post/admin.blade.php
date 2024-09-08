@extends('layouts.app')


@section('content')
@if (auth()->check() && auth()->user()->role === 'admin')
    <div class="card-header">{{ __('Admin Dashboard') }}</div>
    <div class="container mt-5">
        <h2>Pending Job Posts</h2>

        @if ($pendingJobPosts->isEmpty())
            <p>No job posts pending approval yet.</p>
        @else
            <div class="row">
                @foreach ($pendingJobPosts as $jobPost)
                    <div class="col-md-4 mb-4">
                        <div class="card job-card">
                            <img src="{{ $jobPost->image ? asset('storage/' . $jobPost->image) : 'https://via.placeholder.com/500x300' }}" class="card-img-top" alt="Job Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $jobPost->title }}</h5>
                                <p class="card-text">
                                    <strong>Description:</strong> {{ Str::limit($jobPost->description, 100) }}<br>
                                    <strong>Location:</strong> {{ $jobPost->location }}<br>
                                    <strong>Salary from:</strong> {{ $jobPost->s_from }}<br>
                                    <strong>Salary to:</strong> {{ $jobPost->s_to }}
                                </p>
                                <p>Status: {{ $jobPost->status }}</p>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <small>Posted on {{ $jobPost->created_at->format('d M, Y') }}</small>
                                <form action="{{ route('job_posts.approve', $jobPost->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('job_posts.cancel', $jobPost->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endif
@endsection
@section('styles')
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
        .card-footer {
            background-color: #f8f9fa;
        }
        .card-footer .btn {
            width: 48%;
        }
    </style>
    @endsection
    