@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit Student</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.students.update', $student->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $student->user->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $student->user->email) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department', $student->department) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select" required>
                        <option value="active"
                            {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="alert alert-info">
                    Password পরিবর্তন করতে চাইলে আলাদা Password Reset functionality ব্যবহার করবে।
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Student
                </button>

                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection