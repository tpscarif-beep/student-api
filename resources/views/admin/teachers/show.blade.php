@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Teacher Details</h2>

        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Teacher ID</th>
                    <td>{{ $teacher->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $teacher->user->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $teacher->user->email }}</td>
                </tr>

                <tr>
                    <th>Designation</th>
                    <td>{{ $teacher->designation }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $teacher->department }}</td>
                </tr>

                <tr>
                    <th>Total Courses</th>
                    <td>{{ $teacher->courses_count ?? $teacher->courses->count() }}</td>
                </tr>

                <tr>
                    <th>Joined At</th>
                    <td>{{ $teacher->created_at->format('d M Y') }}</td>
                </tr>

            </table>

            <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
               class="btn btn-warning">
                Edit Teacher
            </a>

        </div>
    </div>

</div>

@endsection