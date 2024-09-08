{{--  <!-- resources/views/application/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>List of Applications</h1>

    <!-- Add New Application Button -->
    <a href="{{ route('applications.create') }}" class="btn btn-success">Add New Application</a>

    @if($applications->count())
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>Additional Information</th>
                    <th>Resume</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->date->format('Y-m-d') }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->phone_number }}</td>
                        <td>{{ $application->location }}</td>
                        <td>{{ $application->additional_information }}</td>
                        <td>
                            @if($application->resume)
                                <a href="{{ Storage::url($application->resume) }}" target="_blank">View Resume</a>
                            @else
                                No Resume
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $applications->links() }}
    @else
        <p class="text-center">No applications found.</p>
    @endif
</div>
@endsection  --}}




@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">List of Applications</h1>

    <!-- Add New Application Button -->
    <a href="{{ route('applications.create') }}" class="btn btn-success mb-4">Add New Application</a>

    @if($applications->count())
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>Additional Information</th>
                    <th>Resume</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->date->format('Y-m-d') }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->phone_number }}</td>
                        <td>{{ $application->location }}</td>
                        <td>{{ $application->additional_information }}</td>
                        <td>
                            @if($application->resume)
                                <a href="{{ Storage::url($application->resume) }}" target="_blank" class="btn btn-info btn-sm">View Resume</a>
                            @else
                                <span class="text-muted">No Resume</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $applications->links() }}
        </div>
    @else
        <p class="text-center">No applications found.</p>
    @endif
</div>
@endsection
