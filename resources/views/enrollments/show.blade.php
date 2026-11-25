@extends('layouts.app')

@section('title', 'Enrollment Details')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h4>Enrollment Details</h4>
    </div>

    <div class="card-body">

        <p>
            <strong>Enrollment ID:</strong>
            {{ $enrollment->id }}
        </p>

        <p>
            <strong>Student:</strong>
            {{ $enrollment->student->user->name }}
        </p>

        <p>
            <strong>Student Email:</strong>
            {{ $enrollment->student->user->email }}
        </p>

        <p>
            <strong>Course:</strong>
            {{ $enrollment->course->course_name }}
        </p>

        <p>
            <strong>Teacher:</strong>
            {{ $enrollment->course->teacher->user->name }}
        </p>

        <p>
            <strong>Status:</strong>
            {{ ucfirst($enrollment->status) }}
        </p>


        <a href="{{ route('enrollments.index') }}"
            class="btn btn-secondary">
            Back
        </a>

        <a href="{{ route('enrollments.edit', $enrollment->id) }}"
            class="btn btn-warning">
            Edit
        </a>

    </div>

</div>

@endsection