@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Add New Student</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.students.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Enter student name"
                           required>

                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Enter email"
                           required>

                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department') }}"
                           placeholder="Enter department"
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

                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Student
                </button>

                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection