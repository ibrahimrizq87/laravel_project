@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif
<div class="container w-50 m-auto shadow-lg my-5" style="background-color:#ffffff;">

    <h2 >Create New Application</h2>
    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="job_id" value="{{ $job_id }}">
        @error('job_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
            @error('location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', Auth::user()->candidate->phone) }}">
            @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="resume">Upload Resume</label>
            <input type="file" name="resume" id="resume" class="form-control @error('resume') is-invalid @enderror">
            @error('resume')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="resume_option">Choose Existing Resume</label>
            <select name="resume_option" id="resume_option" class="form-control @error('resume_option') is-invalid @enderror">
                <option value="">Select a resume</option>
                @foreach ($resumes as $resume)
                <option value="{{ $resume->id }}" {{ old('resume_option') == $resume->id ? 'selected' : '' }}>
                    Resume {{ $loop->index + 1 }}
                </option>
                @endforeach
            </select>
            @error('resume_option')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="additional_information">Additional Information</label>
            <textarea name="additional_information" id="additional_information" class="form-control @error('additional_information') is-invalid @enderror">{{ old('additional_information') }}</textarea>
            @error('additional_information')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn" style="background-color:#102C57; color: #ffffff;">Submit</button>

        </div>
    </form>
</div>

<!-- Inline Styling -->
<style>
    .container {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    h2 {
        color: #34495e;
        text-align: center;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
        color: #2c3e50;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn {
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .invalid-feedback {
        color: #e74c3c;
    }
</style>
@endsection
