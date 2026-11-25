@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Enrollment Details</h2>

        <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Enrollment ID</th>
                    <td>{{ $enrollment->id }}</td>
                </tr>

                <tr>
                    <th>Student Name</th>
                    <td>{{ $enrollment->student->user->name }}</td>
                </tr>

                <tr>
                    <th>Student Email</th>
                    <td>{{ $enrollment->student->user->email }}</td>
                </tr>

                <tr>
                    <th>Course Name</th>
                    <td>{{ $enrollment->course->course_name }}</td>
                </tr>

                <tr>
                    <th>Teacher</th>
                    <td>{{ $enrollment->course->teacher->user->name }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($enrollment->status) }}</td>
                </tr>

                <tr>
                    <th>Enrolled At</th>
                    <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                </tr>

            </table>

            <a href="{{ route('admin.enrollments.edit', $enrollment->id) }}"
               class="btn btn-warning">
                Edit Enrollment
            </a>

        </div>
    </div>

</div>

@endsection