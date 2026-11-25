@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">

        {{-- Student Sidebar --}}
        <div class="col-md-3 col-lg-2 bg-success text-white min-vh-100 p-3">

            <h4 class="text-center mb-4">
                Student Panel
            </h4>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="{{ route('student.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('student.courses.index') }}" class="nav-link text-white">
                        Available Courses
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('student.enrollments.index') }}" class="nav-link text-white">
                        My Enrollments
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('student.profile.show') }}" class="nav-link text-white">
                        My Profile
                    </a>
                </li>

            </ul>

        </div>


        {{-- Student Main Content --}}
        <div class="col-md-9 col-lg-10 p-4">

            <div class="mb-4">

                <h3>
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="text-muted">
                    View courses and manage your enrollments.
                </p>

            </div>

            @yield('student-content')

        </div>

    </div>

</div>

@endsection