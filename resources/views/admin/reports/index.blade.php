@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-2">System Reports</h2>

    <p class="text-muted mb-4">
        Overview of students, teachers, courses and enrollments.
    </p>


    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Enrollments</h6>
                    <h2 class="fw-bold text-primary">
                        {{ $totalEnrollments ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Active Enrollments</h6>
                    <h2 class="fw-bold text-success">
                        {{ $activeEnrollments ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Courses</h6>
                    <h2 class="fw-bold text-warning">
                        {{ $courses->count() }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Teachers</h6>
                    <h2 class="fw-bold text-danger">
                        {{ $teachers->count() }}
                    </h2>
                </div>
            </div>
        </div>

    </div>


    {{-- Course Report --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Course Enrollment Report</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Teacher</th>
                            <th>Total Enrollments</th>
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
                                        {{ $course->enrollments_count }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No course data found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>


    {{-- Teacher Report --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Teacher Course Report</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Teacher Name</th>
                            <th>Department</th>
                            <th>Total Courses</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($teachers as $teacher)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $teacher->user->name }}</td>

                                <td>{{ $teacher->department }}</td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ $teacher->courses_count }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No teacher data found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>


    {{-- Recent Enrollment Report --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Recent Enrollment Report</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentEnrollments as $enrollment)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $enrollment->student->user->name }}</td>

                                <td>{{ $enrollment->course->course_name }}</td>

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
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No enrollment records found.
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