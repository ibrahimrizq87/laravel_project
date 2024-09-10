{{--
  @extends('layouts.app')

  @section('content')
  <div class="container">
      <h1 class="mt-4 mb-4">List of Applications</h1>

      <!-- Add New Application Button -->
      <div class="mb-4">
          <a href="{{ route('applications.create') }}" class="btn btn-success">Add New Application</a>
      </div>

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
                          <td>{{ $application->created_at->format('Y-m-d') }}</td>
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
                              <!-- Edit Button -->
                              <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                              <!-- Delete Button (with confirmation) -->
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
  --}}




  @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">List of Applications</h1>

    <!-- Add New Application Button -->
    <div class="mb-4">
        <a href="{{ route('applications.create') }}" class="btn btn-success">Add New Application</a>
    </div>

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
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
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
                            <!-- Edit Button -->
                            <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                            <!-- Delete Button (with confirmation) -->
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

<!-- Inline Styling -->
<style>
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
</style>
@endsection
