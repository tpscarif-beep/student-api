<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            Role Management System
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- Right Side --}}
            <ul class="navbar-nav ms-auto align-items-lg-center">

                @auth
                    {{-- User Name --}}
                    <li class="nav-item me-3">
                        <span class="navbar-text text-white">
                            Welcome, {{ auth()->user()->name }}
                        </span>
                    </li>

                    {{-- User Role --}}
                    <li class="nav-item me-3">
                        <span class="badge bg-primary">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-outline-light btn-sm">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                            Login
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>