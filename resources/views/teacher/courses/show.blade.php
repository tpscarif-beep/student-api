@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Course Details</h2>
            <p class="text-muted">
                View course information and enrolled students.
            </p>
        </div>

        <a href="{{ route('teacher.courses.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>

    {{-- Course Information --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Course Information</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Course ID</th>
                    <td>{{ $course->id }}</td>
                </tr>

                <tr>
                    <th>Course Name</th>
                    <td>{{ $course->course_name }}</td>
                </tr>

                <tr>
                    <th>Teacher</th>
                    <td>{{ $course->teacher->user->name }}</td>
                </tr>

                <tr>
                    <th>Total Students</th>
                    <td>{{ $course->enrollments_count }}</td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $course->created_at->format('d M Y') }}</td>
                </tr>

            </table>

        </div>
    </div>

    {{-- Enrolled Students --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Enrolled Students</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($course->enrollments as $enrollment)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $enrollment->student->user->name }}
                                </td>

                                <td>
                                    {{ $enrollment->student->user->email }}
                                </td>

                                <td>
                                    {{ $enrollment->student->department }}
                                </td>

                                <td>
                                    @if($enrollment->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No students enrolled in this course.
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