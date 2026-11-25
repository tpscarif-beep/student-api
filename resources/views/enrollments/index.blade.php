@extends('layouts.app')

@section('title', 'Enrollments')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Enrollment List</h2>

        <a href="{{ route('enrollments.create') }}"
           class="btn btn-primary">
            + New Enrollment
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>

    @endif


    {{-- Error Messages --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Enrollment Table --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">All Enrollments</h5>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Teacher</th>
                            <th>Status</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($enrollments as $enrollment)

                            <tr>

                                {{-- Enrollment ID --}}
                                <td>
                                    {{ $enrollment->id }}
                                </td>


                                {{-- Student Name --}}
                                <td>
                                    {{ $enrollment->student?->user?->name ?? 'N/A' }}
                                </td>


                                {{-- Course Name --}}
                                <td>
                                    {{ $enrollment->course?->course_name ?? 'N/A' }}
                                </td>


                                {{-- Teacher Name --}}
                                <td>
                                    {{ $enrollment->course?->teacher?->user?->name ?? 'N/A' }}
                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($enrollment->status === 'active')

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- View --}}
                                        <a href="{{ route('enrollments.show', $enrollment->id) }}"
                                           class="btn btn-info btn-sm">
                                            View
                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this enrollment?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-4">

                                    <h5 class="text-muted">
                                        No Enrollments Found
                                    </h5>

                                    <p class="mb-2">
                                        There are currently no student enrollments.
                                    </p>

                                    <a href="{{ route('enrollments.create') }}"
                                       class="btn btn-primary btn-sm">
                                        Create First Enrollment
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Footer --}}
        <div class="card-footer text-muted">

            Total Enrollments: {{ $enrollments->count() }}

        </div>

    </div>

</div>

@endsection