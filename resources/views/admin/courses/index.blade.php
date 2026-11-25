@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Courses Management</h2>
            <p class="text-muted">Manage all available courses.</p>
        </div>

        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            + Add Course
        </a>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Teacher</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($courses as $course)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $course->course_name }}</td>

                                <td>{{ $course->teacher->user->name }}</td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $course->enrollments_count ?? $course->enrollments->count() }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.courses.show', $course->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this course?')">

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
                                <td colspan="5" class="text-center py-4">
                                    No courses found.
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