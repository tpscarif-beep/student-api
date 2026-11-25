@extends('layouts.app')

@section('title', 'Create Course')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Create Course</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('courses.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Course Name</label>

                <input type="text"
                    name="course_name"
                    class="form-control"
                    value="{{ old('course_name') }}"
                    required>

            </div>


            <div class="mb-3">

                <label class="form-label">Select Teacher</label>

                <select name="teacher_id" class="form-select" required>

                    <option value="">Select Teacher</option>

                    @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}"
                            {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                            {{ $teacher->user->name }}
                            ({{ $teacher->department }})

                        </option>

                    @endforeach

                </select>

            </div>


            <button class="btn btn-primary">Save Course</button>

            <a href="{{ route('courses.index') }}"
                class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection