@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0">Login</h3>
                    <small>Welcome to Role Management System</small>
                </div>

                <div class="card-body p-4">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
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
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">
                                Login As
                            </label>

                            <select
                                name="role"
                                id="role"
                                class="form-select @error('role') is-invalid @enderror"
                                required
                            >
                                <option value="">Select Your Role</option>

                                <option value="admin"
                                    {{ old('role') === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="teacher"
                                    {{ old('role') === 'teacher' ? 'selected' : '' }}>
                                    Teacher
                                </option>

                                <option value="student"
                                    {{ old('role') === 'student' ? 'selected' : '' }}>
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
                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                id="remember"
                                class="form-check-input"
                            >

                            <label for="remember" class="form-check-label">
                                Remember Me
                            </label>
                        </div>

                        {{-- Login Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>

                    </form>

                    <hr>

                    {{-- Register Link --}}
                    <div class="text-center">
                        <p class="mb-0">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary fw-bold">
                                Register Now
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection