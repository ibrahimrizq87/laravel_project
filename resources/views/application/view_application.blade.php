@extends('layouts.app')

@section('content')
<div class="container">
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
                    @if($application->resume)
                        <p><a href="{{ asset('storage/' . $application->resume->resume) }}" target="_blank">View Resume</a></p>
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
        </div>
        <div class="card-footer">
            <a href="{{ route('applications.index') }}" class="btn btn-primary">Back to Applications</a>
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
