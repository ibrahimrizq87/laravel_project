@extends('layouts.app')

@section('content')


<div class="container shadow-lg p-5 mt-4 my-4 rounded w-50" style="background-color: white;">

  <h2 class="text-center">Sign In</h2>
  <form method="POST" action="{{ route('login') }}" class="mt-4">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label fs-5 fw-bolder">Email address</label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      <!-- <div id="emailHelp" class="form-text">We'll never share your email with an yone else.</div> -->
    </div>
    <div class="mb-3">
      <label for="password" class="form-label fs-5 fw-bolder">Password</label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label fw-bolder" for="remember" >
          {{ __('Remember Me') }}
        </label>
      </div>
    </div>


    <button type="submit" class="btn btn-secondary" style="background-color:#102C57;">Login</button>
  </form>
</div>

@endsection