<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Student Management System')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .main-content {
            min-height: 80vh;
            padding: 25px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .footer {
            padding: 15px;
            text-align: center;
            background-color: #ffffff;
            border-top: 1px solid #ddd;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Main Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">

            <a class="navbar-brand" href="/">
                Student Management System
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto">

                    @auth

                        <li class="nav-item">
                            <span class="nav-link">
                                {{ auth()->user()->name }}
                            </span>
                        </li>

                        <li class="nav-item">

                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button type="submit" class="btn btn-danger btn-sm mt-1">
                                    Logout
                                </button>

                            </form>

                        </li>

                    @else

                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                Login
                            </a>
                        </li>

                    @endauth

                </ul>

            </div>

        </div>

    </nav>


    {{-- Main Content --}}
    <main class="main-content">

        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        @endif


        {{-- Error Message --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        @yield('content')

    </main>


    {{-- Footer --}}
    <footer class="footer">

        <p class="mb-0">
            &copy; {{ date('Y') }} Student Management System. All Rights Reserved.
        </p>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>