<?php 
use Carbon\Carbon;
?>

@extends('layouts.app')

@section('content')


@if (session('error'))
  
   
<div class="container ">
<div class="alert alert-danger text-center" role="alert">
{{ session('error') }}
</div>
</div>
@endif

@if (session('success'))


<div class="container ">
<div class="alert alert-success text-center" role="alert">
{{ session('success') }}
</div> 
</div>
@endif


<div class="container shadow p-5 mt-5 rounded" style="background-color: #f2f2f2;">
    <img src="{{ asset('images/job.png') }}" width='100'>

    <h2 class="text-center">Update Profile</h2>
    <form method="POST" action="{{ route('users.store') }}" class="mt-5" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>

      
        

        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', ) }}">
            @error('birthdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <br>

        <div class="form-group">
        <label for="gender" class="fw-bolder">Gender</label>
        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


        <div class="input-group mb-3">
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Add Image</label>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


     
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Add user</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection
