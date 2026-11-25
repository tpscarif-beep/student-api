<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white"
     style="width: 250px; min-height: 100vh;">

    {{-- Sidebar Title --}}
    <a href="{{ url('/') }}"
       class="d-flex align-items-center mb-4 text-white text-decoration-none">

        <span class="fs-5 fw-bold">Dashboard Panel</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

        @auth

            {{-- Admin Sidebar --}}
            @if(auth()->user()->role === 'admin')

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.students.index') }}" class="nav-link text-white">
                        Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.teachers.index') }}" class="nav-link text-white">
                        Teachers
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.courses.index') }}" class="nav-link text-white">
                        Courses
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.enrollments.index') }}" class="nav-link text-white">
                        Enrollments
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.reports.index') }}" class="nav-link text-white">
                        Reports
                    </a>
                </li>

            {{-- Teacher Sidebar --}}
            @elseif(auth()->user()->role === 'teacher')

                <li>
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.courses.index') }}" class="nav-link text-white">
                        My Courses
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.students.index') }}" class="nav-link text-white">
                        My Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.profile.show') }}" class="nav-link text-white">
                        My Profile
                    </a>
                </li>

            {{-- Student Sidebar --}}
            @elseif(auth()->user()->role === 'student')

                <li>
                    <a href="{{ route('student.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.courses.index') }}" class="nav-link text-white">
                        Available Courses
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.enrollments.index') }}" class="nav-link text-white">
                        My Enrollments
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.profile.show') }}" class="nav-link text-white">
                        My Profile
                    </a>
                </li>

            @endif

        @endauth

    </ul>

    <hr>

    <div class="small text-secondary">
        Role Management System
    </div>

</div>