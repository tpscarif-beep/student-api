@extends('layouts.app')

@section('title', 'Courses')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>Course List</h2>

    <a href="{{ route('courses.create') }}"
        class="btn btn-primary">
        Add Course
    </a>

</div>


<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Teacher</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @forelse($courses as $course)

                    <tr>

                        <td>{{ $course->id }}</td>

                        <td>{{ $course->course_name }}</td>

                        <td>{{ $course->teacher->user->name }}</td>

                        <td>{{ $course->teacher->department }}</td>

                        <td>

                            <a href="{{ route('courses.show', $course->id) }}"
                                class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('courses.edit', $course->id) }}"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('courses.destroy', $course->id) }}"
                                method="POST" class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No courses found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection