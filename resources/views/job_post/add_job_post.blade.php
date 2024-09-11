@extends('layouts.app')

@section('content')

<style>
    .form-section {
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-section h3 {
        margin-bottom: 20px;
    }

    .btn-edit {
        margin-top: 20px;
        display: block;
    }
</style>


<body>
    <div class="container w-50 m-auto shadow-lg my-5 rounded-3" style="background-color:#ffffff;">


    @if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif

        <h2>Job Post Form</h2>
        <form action="{{ route('job_posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <h2 class="text-center py-5">Post your job</h2>

            @error('job_title')
             <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="job_title" class="fw-bolder">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title">
            </div>


            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="description" class="fw-bolder">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>

            </div>


            @error('responsibilities')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="responsibilities" class="fw-bolder">Responsibilities</label>
                <textarea class="form-control" id="responsibilities" name="responsibilities" rows="3"></textarea>

            </div>


            @error('required_skills')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="required_skills" class="fw-bolder">Required Skills</label>
                <textarea class="form-control" id="required_skills" name="required_skills" rows="3"></textarea>

            </div>


            @error('qualifications')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="qualifications" class="fw-bolder">Qualifications</label>
                <textarea class="form-control" id="qualifications" name="qualifications" rows="3"></textarea>

            </div>
            <div>


                @error('s_from')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="salary_from" class="fw-bolder">Salary From</label>
                <input type="text" class="form-control" id="salary_from" name="s_from">

            </div>
            <div>


                @error('s_to')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
                <label for="salary_to" class="fw-bolder">Salary To</label>
                <input type="text" class="form-control" id="salary_to" name="s_to">

            </div>



            @error('location')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="location" class="fw-bolder">Location</label>
                <input type="text" class="form-control" id="location" name="location">

            </div>



            @error('work_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="work_type" class="fw-bolder">Work Type</label>
                <select class="form-control" id="work_type" name="work_type">
                    <option value="full-time">Full-Time</option>
                    <option value="part-time">Part-Time</option>
                    <option value="freelancing-job">Freelancing Job</option>
                </select>

            </div>


            @error('work_from')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="work_from" class="fw-bolder">Work From</label>
                <select class="form-control" id="work_from" name="work_from">
                    <option value="remote">Remote</option>
                    <option value="on-site">On-Site</option>
                    <option value="hybrid">Hybrid</option>
                </select>

            </div>


            @error('application_deadline')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="application_deadline" class="fw-bolder">Application Deadline</label>
                <input type="date" class="form-control" id="application_deadline" name="application_deadline">

            </div>


            <label for="inputGroupFile02" class="form-label fw-bolder">Profile Image</label>
            <div class="input-group mb-3">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
                <label class="input-group-text" class="fw-bolder" for="inputGroupFile02">User Image</label>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="text-center">
                <button type="submit" class="btn my-2" style="background-color:#102C57; color: #ffffff;">Submit</button>
            </div>
        </form>
    </div>



    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection