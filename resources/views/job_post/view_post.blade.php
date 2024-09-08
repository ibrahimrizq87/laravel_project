


@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <!-- Include Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            margin-bottom: 20px;
        }
        .badge-custom {
            font-size: 0.8rem;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Posts</h1>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <div class="card card-custom">
                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/500x300' }}" class="card-img-top" alt="Job Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">
                        <strong>Description:</strong> {{ Str::limit($post->description, 100) }}<br>
                        <strong>Location:</strong> {{ $post->location }}<br>
                        <strong>Salary from:</strong> {{ $post->s_from }}<br>
                        <strong>Salary to:</strong> {{ $post->s_to }}
                    </p>
                    <span class="badge badge-custom
                        @if($post->status === 'approved')
                            badge-success
                        @elseif($post->status === 'cancel')
                            badge-danger
                        @else
                            badge-warning
                        @endif
                    ">
                        @if($post->status === 'approved')
                            Accepted
                        @elseif($post->status === 'cancel')
                            Rejected
                        @else
                            Pending
                        @endif
                    </span>
                    <div class="mt-3">
                        <a href="{{ route('job_posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('job_posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
@endsection
    