@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit Teacher</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.teachers.update', $teacher->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $teacher->user->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $teacher->user->email) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Designation</label>

                    <input type="text"
                           name="designation"
                           class="form-control"
                           value="{{ old('designation', $teacher->designation) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department', $teacher->department) }}"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Teacher
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