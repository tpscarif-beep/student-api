@extends('layouts.app')

@section('content')

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">

    <div class="row justify-content-center w-100">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="card-header text-center text-white border-0 py-4"
                     style="background: linear-gradient(135deg, #0d6efd, #4f46e5);">

                    <div class="mb-3">
                        <span class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center"
                              style="width: 65px; height: 65px;">

                            <span class="fs-2">🔐</span>

                        </span>
                    </div>

                    <h3 class="fw-bold mb-2">Welcome Back!</h3>

                    <p class="mb-0 text-white-50">
                        Login to your Role Management System
                    </p>

                </div>

                {{-- Card Body --}}
                <div class="card-body p-4 p-md-5">

                    {{-- Validation Errors --}}
                    @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            <strong>Login Failed!</strong>

                            <ul class="mb-0 mt-2">
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
                        <div class="mb-4">

                            <label for="email" class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
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
                        <div class="mb-4">

                            <label for="password" class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control form-control-lg rounded-start-3"
                                    placeholder="Enter your password"
                                    required
                                >

                                <button
                                    class="btn btn-outline-secondary rounded-end-3"
                                    type="button"
                                    onclick="togglePassword()"
                                >
                                    <span id="passwordText">Show</span>
                                </button>

                            </div>

                        </div>

                        {{-- Role --}}
                        <div class="mb-4">

                            <label for="role" class="form-label fw-semibold">
                                Login As
                            </label>

                            <select
                                name="role"
                                id="role"
                                class="form-select form-select-lg rounded-3 @error('role') is-invalid @enderror"
                                required
                            >

                                <option value="">Select Your Role</option>

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
                                    Remember Me
                                </label>

                            </div>

                        </div>

                        {{-- Login Button --}}
                        <div class="d-grid">

                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold py-3 shadow-sm">

                                Sign In

                            </button>

                        </div>

                    </form>

                    {{-- Divider --}}
                    <div class="d-flex align-items-center my-4">

                        <hr class="flex-grow-1">

                        <span class="px-3 text-muted small">OR</span>

                        <hr class="flex-grow-1">

                    </div>

                    {{-- Register Link --}}
                    <div class="text-center">

                        <p class="text-muted mb-0">

                            Don't have an account?

                            <a href="{{ route('register') }}"
                               class="text-primary fw-bold text-decoration-none">

                                Register Now

                            </a>

                        </p>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-white text-center border-top py-3">

                    <small class="text-muted">
                        &copy; {{ date('Y') }} Role Management System. All Rights Reserved.
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
        const text = document.getElementById('passwordText');

        if (password.type === 'password') {

            password.type = 'text';
            text.innerText = 'Hide';

        } else {

            password.type = 'password';
            text.innerText = 'Show';

        }

    }
</script>

@endsection