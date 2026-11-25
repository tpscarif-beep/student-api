@extends('layouts.student')

@section('title', 'Edit Profile')

@section('student-content')

<div class="container-fluid">

    <h3 class="mb-4">Edit Profile</h3>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Update Your Information</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('student.profile.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">

                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $student->user->name) }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Email --}}
                <div class="mb-3">

                    <label class="form-label">Email Address</label>

                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $student->user->email) }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Department --}}
                <div class="mb-3">

                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control @error('department') is-invalid @enderror"
                           value="{{ old('department', $student->department) }}">

                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success">
                    Update Profile
                </button>

                <a href="{{ route('student.profile.show') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection