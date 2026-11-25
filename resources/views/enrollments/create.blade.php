@extends('layouts.app')

@section('title', 'Create Enrollment')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Create Enrollment</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('enrollments.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Select Student</label>

                <select name="student_id" class="form-select" required>

                    <option value="">Select Student</option>

                    @foreach($students as $student)

                        <option value="{{ $student->id }}"
                            {{ old('student_id') == $student->id ? 'selected' : '' }}>

                            {{ $student->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">Select Course</label>

                <select name="course_id" class="form-select" required>

                    <option value="">Select Course</option>

                    @foreach($courses as $course)

                        <option value="{{ $course->id }}"
                            {{ old('course_id') == $course->id ? 'selected' : '' }}>

                            {{ $course->course_name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>

                </select>

            </div>


            <button class="btn btn-primary">
                Enroll Student
            </button>

            <a href="{{ route('enrollments.index') }}"
                class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection