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
    <form method="POST" action="{{ route('users.update', $user) }}" class="mt-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">
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
            <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', $user->birthdate) }}">
            @error('birthdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <br>


        <div class="card mb-3" style="width: 18rem;">
  <img src="{{ asset('uploads/' . $user->image) }}" class="card-img-top" alt="user Image">
  <div class="card-body">
    <h5 class="card-title">Current Image</h5>
    </div>
</div>

        <div class="input-group mb-3">
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Update Image</label>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        @if (Auth::check() && Auth::user()->role == 'candidate')
  


        <div id="candidate-fields" style="display: {{ old('role', $user->role) === 'candidate' ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <textarea id="skills" name="skills" class="form-control @error('skills') is-invalid @enderror">{{ old('skills', optional($user->candidate)->skills) }}</textarea>
                @error('skills')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div class="mb-3">
                <label for="employed" class="form-label">Are you currently employed?</label>
                <select id="employed" name="employed" class="form-select @error('employed') is-invalid @enderror">
                    <option value="employed" {{ old('employed', optional($user->candidate)->employed) === 'employed' ? 'selected' : '' }}>Employed</option>
                    <option value="unemployed" {{ old('employed', optional($user->candidate)->employed) === 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                    <option value="student" {{ old('employed', optional($user->candidate)->employed) === 'student' ? 'selected' : '' }}>Student</option>
                </select>
                @error('employed')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div id="company-field" class="mb-3" style="display: {{ old('employed', optional($user->candidate)->employed) === 'employed' ? 'block' : 'none' }};">
                <label for="company" class="form-label">Company</label>
                <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror" placeholder="Enter company name" value="{{ old('company', optional($user->candidate)->company) }}">
                @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div id="job-description-field" class="mb-3" style="display: {{ old('employed', optional($user->candidate)->employed) === 'employed' ? 'block' : 'none' }};">
                <label for="job-description" class="form-label">Job Description</label>
                <textarea id="job-description" name="job_description" class="form-control @error('job_description') is-invalid @enderror" placeholder="Describe your job">{{ old('job_description', optional($user->candidate)->job_description) }}</textarea>
                @error('job_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div class="row">
            <?php

$counter = 1;

      ?>
            @foreach($user->resumes as $resume)
            <div class="col-sm-3">
            <?php

$date = Carbon::parse($resume->created_at);

      ?>
    
            <div class="card mb-3">
  <div class="card-body text-center">
    <h5 class="card-title">{{$user->name.'resume no. '.$counter}}</h5>
    <p class="card-text"><small class="text-muted">{{$date->diffForHumans()}}</small></p>
    <a href="{{ route('resume.view', $resume->id) }}" class="btn btn-info" target="_blank">View</a>
    <a href="{{ route('resume.download', $resume->id) }}" class="btn btn-outline-info ">Download</a>
    <a href="{{ route('resume.delete', $resume->id) }}" class="btn btn-outline-danger ">Delete</a>
    <?php

$counter ++;

      ?>
</div>
</div>
</div>

        @endforeach

</div>
            <div class="mb-3">
                <label for="cv" class="form-label">Upload Another Resume</label>
                <input type="file" id="cv" name="cv" class="form-control @error('cv') is-invalid @enderror">
                @error('cv')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number" value="{{ old('phone', optional($user->candidate)->phone) }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>
        </div>

 



        @endif

     
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
 

      

        function toggleCompanyFields() {
            if ($('#employed').val() === 'employed') {
                $('#company-field').slideDown();
                $('#job-description-field').slideDown();
            } else {
                $('#company-field').slideUp();
                $('#job-description-field').slideUp();
            }
        }

        toggleCompanyFields();

        $('#employed').on('change', toggleCompanyFields);
    });
</script>


@endsection
