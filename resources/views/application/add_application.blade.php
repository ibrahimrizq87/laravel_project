@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Application</h2>
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

        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection

