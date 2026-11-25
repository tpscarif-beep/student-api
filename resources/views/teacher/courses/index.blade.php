@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">My Courses</h2>
        <p class="text-muted">
            View all courses assigned to you.
        </p>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Total Students</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($courses as $course)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $course->course_name }}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $course->enrollments_count }}
                                    </span>
                                </td>

                                <td>
                                    {{ $course->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    <a href="{{ route('teacher.courses.show', $course->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View Details
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No courses assigned to you.
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