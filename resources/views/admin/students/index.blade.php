@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Students Management</h2>
            <p class="text-muted">Manage all registered students.</p>
        </div>

        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($students as $student)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $student->user->name }}</td>

                                <td>{{ $student->user->email }}</td>

                                <td>{{ $student->department }}</td>

                                <td>
                                    @if($student->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.students.show', $student->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this student?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>
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