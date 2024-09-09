@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Post Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
    <div class="container mt-5">
        <h2>Job Post Form</h2>
        <form action="{{ route('job_posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h3>Job Details</h3>

                @error('job_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title">
                   
                </div>


                @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                   
                </div>


                @error('responsibilities')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="responsibilities">Responsibilities</label>
                    <textarea class="form-control" id="responsibilities" name="responsibilities" rows="3"></textarea>
                  
                </div>


                @error('required_skills')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="required_skills">Required Skills</label>
                    <textarea class="form-control" id="required_skills" name="required_skills" rows="3"></textarea>
                 
                </div>


                @error('qualifications')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="qualifications">Qualifications</label>
                    <textarea class="form-control" id="qualifications" name="qualifications" rows="3"></textarea>
                   
                </div>
<div>


@error('s_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <label for="salary_from">Salary From</label>
<input type="text" class="form-control" id="salary_from" name="s_from">

    </div>
    <div>


    @error('s_to')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
<label for="salary_to">Salary To</label>
<input type="text" class="form-control" id="salary_to" name="s_to">

    </div>



    @error('location')
                        <div class="alert alert-danger mt-3"  >{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location">
                 
                </div>



                @error('work_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label for="work_type">Work Type</label>
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
                    <label for="work_from">Work From</label>
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
                    <label for="application_deadline">Application Deadline</label>
                    <input type="date" class="form-control" id="application_deadline" name="application_deadline">
                   
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

             

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
