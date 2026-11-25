@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">

        {{-- Admin Sidebar --}}
        <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100 p-3">

            <h4 class="text-center mb-4">
                Admin Panel
            </h4>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.students.index') }}" class="nav-link text-white">
                        Students
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.teachers.index') }}" class="nav-link text-white">
                        Teachers
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.courses.index') }}" class="nav-link text-white">
                        Courses
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.enrollments.index') }}" class="nav-link text-white">
                        Enrollments
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link text-white">
                        Reports
                    </a>
                </li>

            </ul>

        </div>


        {{-- Admin Main Content --}}
        <div class="col-md-9 col-lg-10 p-4">

            <div class="mb-4">

                <h3>
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="text-muted">
                    Manage your entire application from here.
                </p>

            </div>

            @yield('admin-content')

        </div>

    </div>

</div>

@endsection