@extends('layouts.app')

@section('title', 'Edit Enrollment')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Edit Enrollment</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('enrollments.update', $enrollment->id) }}"
            method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label class="form-label">Student</label>

                <select name="student_id" class="form-select" required>

                    @foreach($students as $student)

                        <option value="{{ $student->id }}"
                            {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>

                            {{ $student->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">Course</label>

                <select name="course_id" class="form-select" required>

                    @foreach($courses as $course)

                        <option value="{{ $course->id }}"
                            {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>

                            {{ $course->course_name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active"
                        {{ $enrollment->status == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ $enrollment->status == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            <button class="btn btn-primary">
                Update Enrollment
            </button>

            <a href="{{ route('enrollments.index') }}"
                class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection