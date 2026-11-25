@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-2">Enrollments Management</h2>

    <p class="text-muted mb-4">
        View and manage student course enrollments.
    </p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Teacher</th>
                            <th>Status</th>
                            <th>Enrolled At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($enrollments as $enrollment)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $enrollment->student->user->name }}</td>

                                <td>{{ $enrollment->course->course_name }}</td>

                                <td>{{ $enrollment->course->teacher->user->name }}</td>

                                <td>
                                    @if($enrollment->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $enrollment->created_at->format('d M Y') }}
                                </td>

                                <td>

                                    <a href="{{ route('admin.enrollments.show', $enrollment->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <a href="{{ route('admin.enrollments.edit', $enrollment->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this enrollment?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No enrollments found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection