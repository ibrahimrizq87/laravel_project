{{--  <!-- resources/views/application/add_application.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Application</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="job_id">Job ID:</label>
            <input type="number" name="job_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="resume">Resume:</label>
            <input type="file" name="resume" class="form-control">
        </div>
        <div class="form-group">
            <label for="additional_information">Additional Information:</label>
            <textarea name="additional_information" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection  --}}



@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4 mb-4">Add Application</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        </div>
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" class="form-control" value="{{ old('user_id') }}" required>
        </div>
        <div class="form-group">
            <label for="job_id">Job ID:</label>
            <input type="number" name="job_id" class="form-control" value="{{ old('job_id') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
        </div>
        <div class="form-group">
            <label for="resume">Resume (Optional):</label>
            <input type="file" name="resume" class="form-control">
        </div>
        <div class="form-group">
            <label for="additional_information">Additional Information:</label>
            <textarea name="additional_information" class="form-control">{{ old('additional_information') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
