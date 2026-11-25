@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit Enrollment</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.enrollments.update', $enrollment->id) }}"
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
                    <label class="form-label">Enrollment Status</label>

                    <select name="status" class="form-select" required>

                        <option value="active"
                            {{ old('status', $enrollment->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $enrollment->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Enrollment
                </button>

                <a href="{{ route('admin.enrollments.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection