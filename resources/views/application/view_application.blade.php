@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif

    <div class="card">
        <div class="card-header">
            <h3>Application Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Email:</strong>
                    <p>{{ $application->email }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Phone Number:</strong>
                    <p>{{ $application->phone_number }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Resume:</strong>
                    
                    @if($resume)
                        <p><a href="{{ asset('uploads/' . $resume->resume) }}" target="_blank">View Resume</a></p>
                    @else
                        <p>No resume uploaded.</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <strong>Location:</strong>
                    <p>{{ $application->location }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>Additional Information:</strong>
                    <p>{{ $application->additional_information }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>Application Date:</strong>
                    <p>{{ $application->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Display Application Status -->
            @if($application->status)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Status:</strong>
                        <p>{{ ucfirst($application->status) }}</p>
                    </div>
                </div>
            @endif

            <!-- Status Update Form for Admins/Employers -->
            @if(Auth::user()->isAdmin() || Auth::user()->isEmployer())
                <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="status">Change Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="cancelled" {{ $application->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                </form>
            @endif
        </div>
        <div class="card-footer">
            @if(Auth::user()->isEmployer() || Auth::user()->isAdmin())
                <a href="{{ route('job_posts.show',$application->jobPost->id) }}" class="btn btn-secondary">Return to Job Details</a>
            @endif
        </div>
    </div>
</div>

<!-- Add simple styles for better readability -->
<style>
    .container {
        margin-top: 30px;
    }
    .card {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #343a40;
        color: #ffffff;
        padding: 15px;
        text-align: center;
    }
    .card-body {
        padding: 20px;
    }
    .card-footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
    }
    h3 {
        margin: 0;
    }
    .row {
        margin-bottom: 15px;
    }
    .btn {
        padding: 10px 20px;
    }
</style>
@endsection
