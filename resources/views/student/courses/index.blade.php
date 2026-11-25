@extends('layouts.student')

@section('title', 'Available Courses')

@section('student-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Available Courses</h3>

        <a href="{{ route('student.enrollments.index') }}"
           class="btn btn-outline-primary">
            My Enrollments
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            @if($courses->isEmpty())

                <div class="alert alert-info mb-0">
                    No available courses found.
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
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($courses as $course)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $course->course_name }}</td>

                                    <td>
                                        {{ $course->teacher->user->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $course->teacher->department ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('student.courses.show', $course->id) }}"
                                           class="btn btn-info btn-sm text-white">
                                            View Details
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>
    </div>

</div>

@endsection