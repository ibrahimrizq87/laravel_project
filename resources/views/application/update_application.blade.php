{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Application</h2>

    <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $application->date }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $application->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $application->phone_number }}" required>
        </div>

        <div class="form-group">
            <label for="resume">Resume</label>
            <select name="resume" class="form-control">
                <option value="">Select a saved resume</option>
                @foreach($resumes as $resume)
                    <option value="{{ $resume->file_path }}" {{ $application->resume == $resume->file_path ? 'selected' : '' }}>{{ $resume->name }}</option>
                @endforeach
            </select>
            <input type="file" name="resume" class="form-control mt-2">
        </div>

        <div class="form-group">
            <label for="additional_information">Additional Information</label>
            <textarea name="additional_information" class="form-control">{{ $application->additional_information }}</textarea>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $application->location }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection  --}}



{{--  <!-- resources/views/application/update_application.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Application</h2>

    <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $application->date->format('Y-m-d')) }}" required>
        </div  --}}




        @extends('layouts.app')

        @section('content')
        <div class="container">
            <h2 class="mt-4 mb-4">Update Application</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $application->date->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $application->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $application->phone_number) }}" required>
                </div>

                <div class="form-group">
                    <label for="resume">Resume:</label>
                    <input type="file" name="resume" class="form-control mt-2">
                    @if($application->resume)
                        <p>Current Resume: <a href="{{ Storage::url($application->resume) }}" target="_blank">View Resume</a></p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="additional_information">Additional Information:</label>
                    <textarea name="additional_information" class="form-control">{{ old('additional_information', $application->additional_information) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $application->location) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        @endsection
