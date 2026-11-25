@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">

        {{-- Teacher Sidebar --}}
        <div class="col-md-3 col-lg-2 bg-primary text-white min-vh-100 p-3">

            <h4 class="text-center mb-4">
                Teacher Panel
            </h4>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('teacher.courses.index') }}" class="nav-link text-white">
                        My Courses
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('teacher.students.index') }}" class="nav-link text-white">
                        My Students
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('teacher.profile.show') }}" class="nav-link text-white">
                        My Profile
                    </a>
                </li>

            </ul>

        </div>


        {{-- Teacher Main Content --}}
        <div class="col-md-9 col-lg-10 p-4">

            <div class="mb-4">

                <h3>
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="text-muted">
                    Manage your courses and students.
                </p>

            </div>

            @yield('teacher-content')

        </div>

    </div>

</div>

@endsection