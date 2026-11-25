@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Create New Course</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.courses.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Course Name</label>

                    <input type="text"
                           name="course_name"
                           class="form-control"
                           value="{{ old('course_name') }}"
                           placeholder="Enter course name"
                           required>

                    @error('course_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Teacher</label>

                    <select name="teacher_id" class="form-select" required>

                        <option value="">Select Teacher</option>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->user->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('teacher_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Course
                </button>

                <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection