@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit My Profile</h2>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teacher.profile.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">

                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $teacher->user->name) }}"
                           required>

                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Email --}}
                <div class="mb-3">

                    <label class="form-label">Email Address</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $teacher->user->email) }}"
                           required>

                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Designation --}}
                <div class="mb-3">

                    <label class="form-label">Designation</label>

                    <input type="text"
                           name="designation"
                           class="form-control"
                           value="{{ old('designation', $teacher->designation) }}"
                           required>

                    @error('designation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Department --}}
                <div class="mb-3">

                    <label class="form-label">Department</label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department', $teacher->department) }}"
                           required>

                    @error('department')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">
                    Update Profile
                </button>

                <a href="{{ route('teacher.profile.show') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection