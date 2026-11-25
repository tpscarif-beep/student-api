@extends('layouts.student')

@section('title', 'My Profile')

@section('student-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>My Profile</h3>

        <a href="{{ route('student.profile.edit') }}"
           class="btn btn-primary">
            Edit Profile
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Personal Information</h5>
        </div>

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
                    <td>
                        @if($student->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Account Role</th>
                    <td>Student</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection