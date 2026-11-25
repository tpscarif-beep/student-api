@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7 col-lg-6">

            <div class="card shadow border-0">

                {{-- Card Header --}}
                <div class="card-header bg-success text-white text-center py-3">
                    <h3 class="mb-0">Student Registration</h3>
                    <small>Create your student account</small>
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

                    {{-- Registration Form --}}
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

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
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Department --}}
                        <div class="mb-3">
                            <label for="department" class="form-label">
                                Department
                            </label>

                            <input
                                type="text"
                                name="department"
                                id="department"
                                class="form-control @error('department') is-invalid @enderror"
                                value="{{ old('department') }}"
                                placeholder="Enter your department"
                                required
                            >

                            @error('department')
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
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Create a password"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Confirm your password"
                                required
                            >
                        </div>

                        {{-- Register Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Create Account
                            </button>
                        </div>

                    </form>

                    <hr>

                    {{-- Login Link --}}
                    <div class="text-center">
                        <p class="mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-success fw-bold">
                                Login Now
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection