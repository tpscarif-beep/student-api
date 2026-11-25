@extends('layouts.app')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">

    <div class="row justify-content-center w-100">

        <div class="col-md-6 col-lg-5 col-xl-4">

            <div class="card border shadow-sm">

                {{-- Header --}}
                <div class="card-header bg-white text-center py-4">

                    <h3 class="fw-bold text-dark mb-2">
                        Login
                    </h3>

                    <p class="text-muted mb-0">
                        Welcome back! Please login to your account.
                    </p>

                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    {{-- Validation Errors --}}
                    @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show">

                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                        </div>

                    @endif

                    {{-- Login Form --}}
                    <form action="{{ route('login') }}" method="POST">

                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">

                            <label for="email" class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Enter your email address"
                                required
                                autofocus
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Password --}}
                        <div class="mb-3">

                            <label for="password" class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    onclick="togglePassword()"
                                >
                                    Show
                                </button>

                            </div>

                        </div>

                        {{-- Role --}}
                        <div class="mb-3">

                            <label for="role" class="form-label fw-semibold">
                                Login As
                            </label>

                            <select
                                name="role"
                                id="role"
                                class="form-select @error('role') is-invalid @enderror"
                                required
                            >

                                <option value="">Select your role</option>

                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>
                                    Teacher
                                </option>

                                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
                                    Student
                                </option>

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-4">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    id="remember"
                                    class="form-check-input"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <label for="remember" class="form-check-label">
                                    Remember me
                                </label>

                            </div>

                        </div>

                        {{-- Login Button --}}
                        <div class="d-grid">

                            <button type="submit" class="btn btn-primary fw-semibold py-2">
                                Login
                            </button>

                        </div>

                    </form>

                    {{-- Register Link --}}
                    <hr class="my-4">

                    <div class="text-center">

                        <span class="text-muted">
                            Don't have an account?
                        </span>

                        <a href="{{ route('register') }}"
                           class="text-primary text-decoration-none fw-semibold">

                            Register Now

                        </a>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-light text-center py-3">

                    <small class="text-muted">
                        &copy; {{ date('Y') }} Role Management System
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Password Toggle --}}
<script>
    function togglePassword() {

        const password = document.getElementById('password');
        const button = document.querySelector('.input-group button');

        if (password.type === 'password') {
            password.type = 'text';
            button.innerText = 'Hide';
        } else {
            password.type = 'password';
            button.innerText = 'Show';
        }

    }
</script>

@endsection