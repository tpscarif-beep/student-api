@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('student-content')

<div class="container-fluid">

    <h3 class="mb-4">Student Dashboard</h3>

    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Enrollments</h6>
                    <h2>{{ $totalEnrollments ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Active Enrollments</h6>
                    <h2 class="text-success">{{ $activeEnrollments ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Inactive Enrollments</h6>
                    <h2 class="text-danger">{{ $inactiveEnrollments ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Enrollments --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Recent Enrollments</h5>
        </div>

        <div class="card-body">

            @if($recentEnrollments->isEmpty())

                <p class="text-muted mb-0">You have no enrollments yet.</p>

            @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Teacher</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($recentEnrollments as $enrollment)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $enrollment->course->course_name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $enrollment->course->teacher->user->name ?? 'N/A' }}
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

                            @endforeach
                        </tbody>

                    </table>
                </div>

            @endif

            <a href="{{ route('student.enrollments.index') }}"
               class="btn btn-primary btn-sm">
                View All Enrollments
            </a>

        </div>
    </div>

</div>

@endsection