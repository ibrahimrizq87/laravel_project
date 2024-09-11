



  @extends('layouts.app')

@section('content')
<div class="container">

@if(session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}</div>
@endif

    <h1 class="mt-4 mb-4">List of Applications</h1>

 

    @if($applications->count())
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>status</th>
                    <th>Additional Information</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->phone_number }}</td>
                        <td>{{ $application->location }}</td>
                        @if ($application->status =='approved')
                        <td class = 'text-success'><strong>{{ $application->status }}</strong></td>
                        @else
                        <td class = 'text-warning'><strong>{{ $application->status }}</strong></td>

                        @endif
                        <td>{{ $application->additional_information }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('job_posts.show', $application->jobPost->id) }}" class="btn btn-outline-success btn-sm mb-1">View post</a>
                            <a href="{{ route('applications.show', $application->id) }}" class="btn btn-warning btn-sm mb-1">View</a>
                            @if ($application->status =='approved')
                         <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="pagination justify-content-center mt-4">
    {{ $applications->links('pagination::bootstrap-4') }}
</div>




    @else
    <p class="text-center">No applications found.</p>
    @endif
</div>

<!-- Inline Styling -->
<!-- <style>
    .container {
        background-color: #f7f9fc;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #34495e;
        text-align: center;
    }

    table {
        background-color: white;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table th {
        background-color: #2c3e50;
        color: white;
        text-align: center;
    }

    table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn {
        border-radius: 20px;
        padding: 5px 15px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .pagination {
        justify-content: center;
    }

    .text-center {
        color: #6c757d;
    }
</style> -->
@endsection