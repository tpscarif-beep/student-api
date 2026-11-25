@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Add New Teacher</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.teachers.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Designation</label>

                    <input type="text"
                           name="designation"
                           class="form-control"
                           value="{{ old('designation') }}"
                           placeholder="e.g. Lecturer"
                           required>
                    @error('designation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department') }}"
                           required>
                    @error('department')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>

                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Teacher
                </button>

                <a href="{{ route('admin.teachers.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection