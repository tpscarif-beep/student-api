@extends('layouts.teacher')

@section('teacher-content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">My Students</h2>
        <p class="text-muted">
            Students enrolled in your courses.
        </p>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Total Enrollments</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($students as $student)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $student->user->name }}
                                </td>

                                <td>
                                    {{ $student->user->email }}
                                </td>

                                <td>
                                    {{ $student->department }}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $student->enrollments_count }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('teacher.students.show', $student->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No students found.
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