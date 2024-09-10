@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-5 mt-4 my-4 rounded w-50" style="background-color: #ffffff;">
    
    <h2 class="text-center fst-italic">Registeration</h2>
    <form method="POST" action="{{ route('register') }}" class="mt-5" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-bolder">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bolder">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-bolder">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label fw-bolder">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>


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
    <br>
    
    <div class="form-group">
        <label for="birthdate" class="fw-bolder">Birthdate</label>
        <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}" required>
        @error('birthdate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

<br>
    <label for="inputGroupFile02" class="form-label fw-bolder">Profile Image</label>

        <div class="input-group mb-3">

            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">User Image</label>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
        </div>

        <label for="role" class="form-label fw-bolder">User Type</label>
        <div class="input-group mb-3">
            <select id="role" name='role' class="form-select @error('role') is-invalid @enderror">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose...</option>
                <option value="employer" {{ old('role') === 'employer' ? 'selected' : '' }}>Employer</option>
                <option value="candidate" {{ old('role') === 'candidate' ? 'selected' : '' }}>Candidate</option>
            </select>
            <label class="input-group-text" for="role">Options</label>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
        </div>

        <div id="candidate-fields" style="display: {{ old('role') === 'candidate' ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="skills" class="form-label fw-bolder">Skills</label>
                <textarea id="skills" name="skills" class="form-control @error('skills') is-invalid @enderror" placeholder="Enter your skills">{{ old('skills') }}</textarea>
                @error('skills')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>

            <div class="mb-3">
                <label for="employed" class="form-label fw-bolder">Are you currently employed?</label>
                <select id="employed" name="employed" class="form-select @error('employed') is-invalid @enderror">
                    <option value="employed" {{ old('employed') === 'employed' ? 'selected' : '' }}>Employed</option>
                    <option value="unemployed" {{ old('employed') === 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                    <option value="student" {{ old('employed') === 'student' ? 'selected' : '' }}>Student</option>
                </select>
                @error('employed')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>

            <div id="company-field" class="mb-3" style="display: {{ old('employed') === 'employed' ? 'block' : 'none' }};">
                <label for="company" class="form-label fw-bolder">Company</label>
                <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror" placeholder="Enter company name" value="{{ old('company') }}">
                @error('company')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>

            <div id="job-description-field" class="mb-3" style="display: {{ old('employed') === 'employed' ? 'block' : 'none' }};">
                <label for="job-description" class="form-label fw-bolder">Job Description</label>
                <textarea id="job-description" name="job_description" class="form-control @error('job_description') is-invalid @enderror" placeholder="Describe your job">{{ old('job_description') }}</textarea>
                @error('job_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>
          

            <div class="mb-3">
                <label for="cv" class="form-label fw-bolder">Upload CV</label>
                <input type="file" id="cv" name="cv" class="form-control @error('cv') is-invalid @enderror">
                @error('cv')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-bolder">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number" value="{{ old('phone') }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror  
            </div>
        </div>

        <button type="submit" class="btn" style="background-color:#102C57; color:#ffffff">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function toggleCandidateFields() {
            if ($('#role').val() === 'candidate') {
                $('#candidate-fields').slideDown();
            } else {
                $('#candidate-fields').slideUp();
                $('#company-field').slideUp();
                $('#job-description-field').slideUp(); 
            }
        }

        function toggleCompanyFields() {
            if ($('#employed').val() === 'employed') {
                $('#company-field').slideDown();
                $('#job-description-field').slideDown();
            } else {
                $('#company-field').slideUp();
                $('#job-description-field').slideUp();
            }
        }

        toggleCandidateFields();
        toggleCompanyFields();

        $('#role').on('change', toggleCandidateFields);
        $('#employed').on('change', toggleCompanyFields);
    });
</script>
@endsection
