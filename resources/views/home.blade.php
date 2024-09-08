@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection
