@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Admin Dashboard</h2>
            <p class="text-muted mb-0">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>

        <div>
            <span class="badge bg-primary fs-6">
                Administrator
            </span>
        </div>

    </div>


    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4">

        {{-- Total Students --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="text-muted">Total Students</h6>

                    <h2 class="fw-bold text-primary">
                        {{ $totalStudents ?? 0 }}
                    </h2>

                    <a href="{{ route('admin.students.index') }}"
                       class="text-decoration-none">
                        View Students →
                    </a>

                </div>
            </div>
        </div>


        {{-- Total Teachers --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="text-muted">Total Teachers</h6>

                    <h2 class="fw-bold text-success">
                        {{ $totalTeachers ?? 0 }}
                    </h2>

                    <a href="{{ route('admin.teachers.index') }}"
                       class="text-decoration-none">
                        View Teachers →
                    </a>

                </div>
            </div>
        </div>


        {{-- Total Courses --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="text-muted">Total Courses</h6>

                    <h2 class="fw-bold text-warning">
                        {{ $totalCourses ?? 0 }}
                    </h2>

                    <a href="{{ route('admin.courses.index') }}"
                       class="text-decoration-none">
                        View Courses →
                    </a>

                </div>
            </div>
        </div>


        {{-- Total Enrollments --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="text-muted">Total Enrollments</h6>

                    <h2 class="fw-bold text-danger">
                        {{ $totalEnrollments ?? 0 }}
                    </h2>

                    <a href="{{ route('admin.enrollments.index') }}"
                       class="text-decoration-none">
                        View Enrollments →
                    </a>

                </div>
            </div>
        </div>

    </div>


    {{-- Recent Students --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">Recent Students</h5>

                <a href="{{ route('admin.students.index') }}"
                   class="btn btn-sm btn-primary">
                    View All
                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Joined</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentStudents ?? [] as $student)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $student->user->name }}
                                </td>

                                <td>
                                    {{ $student->user->email }}
                                </td>

                                <td>
                                    {{ $student->department }}
                                </td>

                                <td>
                                    @if($student->status === 'active')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $student->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No students found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Recent Enrollments --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">Recent Enrollments</h5>

                <a href="{{ route('admin.enrollments.index') }}"
                   class="btn btn-sm btn-primary">
                    View All
                </a>

            </div>

        </div>

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
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentEnrollments ?? [] as $enrollment)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $enrollment->student->user->name }}
                                </td>

                                <td>
                                    {{ $enrollment->course->course_name }}
                                </td>

                                <td>
                                    {{ $enrollment->course->teacher->user->name }}
                                </td>

                                <td>
                                    @if($enrollment->status === 'active')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $enrollment->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No enrollments found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Courses Overview --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0 fw-bold">Courses Overview</h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Teacher</th>
                            <th>Total Students</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($courses ?? [] as $course)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $course->course_name }}
                                </td>

                                <td>
                                    {{ $course->teacher->user->name }}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $course->enrollments_count }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
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