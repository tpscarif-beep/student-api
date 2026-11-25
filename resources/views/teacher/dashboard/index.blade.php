@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold">Teacher Dashboard</h2>
        <p class="text-muted">
            Welcome back, {{ auth()->user()->name }}!
        </p>
    </div>

    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">My Courses</h6>
                    <h2 class="fw-bold text-primary">
                        {{ $totalCourses ?? 0 }}
                    </h2>
                    <a href="{{ route('teacher.courses.index') }}">
                        View Courses →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Enrollments</h6>
                    <h2 class="fw-bold text-success">
                        {{ $totalEnrollments ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Active Enrollments</h6>
                    <h2 class="fw-bold text-warning">
                        {{ $activeEnrollments ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Inactive Enrollments</h6>
                    <h2 class="fw-bold text-danger">
                        {{ $inactiveEnrollments ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Enrollments --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Recent Enrollments</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

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
                                <td colspan="5" class="text-center py-4">
                                    No recent enrollments found.
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