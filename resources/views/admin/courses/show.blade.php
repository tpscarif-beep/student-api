@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Course Details</h2>

        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm">
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
                    <th>Total Enrollments</th>
                    <td>{{ $course->enrollments_count ?? $course->enrollments->count() }}</td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $course->created_at->format('d M Y') }}</td>
                </tr>

            </table>

            <a href="{{ route('admin.courses.edit', $course->id) }}"
               class="btn btn-warning">
                Edit Course
            </a>

        </div>
    </div>

</div>

@endsection