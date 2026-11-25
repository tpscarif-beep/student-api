@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit Course</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.courses.update', $course->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Course Name</label>

                    <input type="text"
                           name="course_name"
                           class="form-control"
                           value="{{ old('course_name', $course->course_name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Teacher</label>

                    <select name="teacher_id" class="form-select" required>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->user->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Course
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