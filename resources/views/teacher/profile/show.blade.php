@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">My Profile</h2>

        <a href="{{ route('teacher.profile.edit') }}"
           class="btn btn-primary">
            Edit Profile
        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Personal Information</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Name</th>
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
                    <th>Account Role</th>
                    <td>
                        <span class="badge bg-primary">Teacher</span>
                    </td>
                </tr>

                <tr>
                    <th>Joined At</th>
                    <td>{{ $teacher->created_at->format('d M Y') }}</td>
                </tr>

            </table>

        </div>
    </div>

</div>

@endsection