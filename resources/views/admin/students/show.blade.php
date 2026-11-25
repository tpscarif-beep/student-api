@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Student Details</h2>

        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Student ID</th>
                    <td>{{ $student->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $student->user->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $student->user->email }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $student->department }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($student->status) }}</td>
                </tr>

                <tr>
                    <th>Registered At</th>
                    <td>{{ $student->created_at->format('d M Y') }}</td>
                </tr>

            </table>

            <a href="{{ route('admin.students.edit', $student->id) }}"
               class="btn btn-warning">
                Edit Student
            </a>

        </div>
    </div>

</div>

@endsection