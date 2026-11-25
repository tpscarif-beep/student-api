@extends('layouts.student')

@section('title', 'My Enrollments')

@section('student-content')

<div class="container-fluid">

    <h3 class="mb-4">My Enrollments</h3>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            @if($enrollments->isEmpty())

                <div class="alert alert-info mb-0">
                    You have not enrolled in any course yet.
                </div>

            @else

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Teacher</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Enrollment Date</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($enrollments as $enrollment)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $enrollment->course->course_name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $enrollment->course->teacher->user->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $enrollment->course->teacher->department ?? 'N/A' }}
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

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

            <a href="{{ route('student.courses.index') }}"
               class="btn btn-primary btn-sm">
                Browse Courses
            </a>

        </div>

    </div>

</div>

@endsection