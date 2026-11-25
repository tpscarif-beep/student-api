@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Student Details</h2>

        <a href="{{ route('teacher.students.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>

    {{-- Student Information --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Student Information</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Student ID</th>
                    <td>{{ $student->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $student->user->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $student->user->email }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $student->department }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($student->status) }}</td>
                </tr>

            </table>

        </div>
    </div>

    {{-- Teacher's Course Enrollments --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Enrollments in My Courses</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Enrollment Status</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($student->enrollments as $enrollment)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $enrollment->course->course_name }}
                                </td>

                                <td>
                                    @if($enrollment->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $enrollment->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    No enrollments found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection