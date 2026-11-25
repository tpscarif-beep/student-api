@extends('layouts.student')

@section('title', 'Course Details')

@section('student-content')

<div class="container-fluid">

    <div class="mb-4">
        <a href="{{ route('student.courses.index') }}"
           class="btn btn-outline-secondary btn-sm">
            Back to Courses
        </a>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h4 class="mb-0">Course Details</h4>
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
                    <th>Teacher Name</th>
                    <td>{{ $course->teacher->user->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $course->teacher->department ?? 'N/A' }}</td>
                </tr>

            </table>

            <form action="{{ route('student.courses.enroll', $course->id) }}"
                  method="POST">

                @csrf

                <button type="submit" class="btn btn-success">
                    Enroll in This Course
                </button>

            </form>

        </div>

    </div>

</div>

@endsection