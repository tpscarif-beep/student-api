@extends('layouts.app')

@section('title', 'Course Details')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Course Details</h4>
    </div>

    <div class="card-body">

        <p><strong>Course ID:</strong> {{ $course->id }}</p>

        <p><strong>Course Name:</strong> {{ $course->course_name }}</p>

        <p><strong>Teacher:</strong> {{ $course->teacher->user->name }}</p>

        <p><strong>Department:</strong> {{ $course->teacher->department }}</p>


        <a href="{{ route('courses.index') }}"
            class="btn btn-secondary">
            Back
        </a>

        <a href="{{ route('courses.edit', $course->id) }}"
            class="btn btn-warning">
            Edit
        </a>

    </div>

</div>

@endsection