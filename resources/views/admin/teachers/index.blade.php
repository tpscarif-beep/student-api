@extends('layouts.admin')

@section('admin-content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Teachers Management</h2>
            <p class="text-muted">Manage all teachers.</p>
        </div>

        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            + Add Teacher
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
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($teachers as $teacher)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $teacher->user->name }}</td>

                                <td>{{ $teacher->user->email }}</td>

                                <td>{{ $teacher->designation }}</td>

                                <td>{{ $teacher->department }}</td>

                                <td>
                                    <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this teacher?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No teachers found.
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