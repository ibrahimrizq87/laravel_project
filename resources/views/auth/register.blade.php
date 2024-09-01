@extends('layouts.app')

@section('content')

<div class="container shadow p-5 mt-5 rounded" style="background-color: #f2f2f2;">
    <img src="{{ asset('images/job.png') }}" width='100'>

    <h2 class="text-center">Registration</h2>
    <form method="POST" action="{{ route('register') }}" class="mt-5" enctype="multipart/form-data">
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

        <label for="role" class="form-label">User Type</label>
        <div class="input-group mb-3">
            <select id="role" name='role' class="form-select @error('role') is-invalid @enderror">
                <option selected>Choose...</option>
                <option value="employer">employer</option>
                <option value="candidate">candidate</option>
            </select>
            <label class="input-group-text" for="role">Options</label>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
        </div>

        <label for="inputGroupFile02" class="form-label">Profile Image</label>
        <div class="input-group mb-3">
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">User Image</label>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
        </div>

        <button type="submit" class="btn btn-secondary">Register</button>
    </form>
</div>

@endsection
