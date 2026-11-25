@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Edit Course</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('courses.update', $course->id) }}"
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

                <label class="form-label">Teacher</label>

                <select name="teacher_id" class="form-select" required>

                    @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}"
                            {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>

                            {{ $teacher->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <button class="btn btn-primary">Update Course</button>

            <a href="{{ route('courses.index') }}"
                class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection