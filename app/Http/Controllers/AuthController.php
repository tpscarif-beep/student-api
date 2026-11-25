<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Register Page
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | Student Registration
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email',

            'password' => 'required|string|min:8|confirmed',

            'department' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],

                // User Model hashed cast handles password hashing
                'password' => $validated['password'],

                // Public registration only creates students
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'department' => $validated['department'],
                'status' => 'active',
            ]);

        });

        return redirect()
            ->route('login')
            ->with('success', 'Registration successful. Please login.');
    }


    /*
    |--------------------------------------------------------------------------
    | Show Login Page
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',

            'password' => 'required|string',

            'role' => 'required|in:admin,teacher,student',
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        // Attempt Authentication
        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            return back()
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ])
                ->onlyInput('email', 'role');
        }

        $user = Auth::user();

        // Verify Selected Role
        if ($user->role !== $validated['role']) {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'role' => 'Selected role does not match your account.',
                ])
                ->onlyInput('email', 'role');
        }

        // Regenerate Session
        $request->session()->regenerate();

        // Redirect According to Role
        return match ($user->role) {

            'admin' => redirect()->route('admin.dashboard'),

            'teacher' => redirect()->route('teacher.dashboard'),

            'student' => redirect()->route('student.dashboard'),

            default => abort(403, 'Invalid user role.'),

        };
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have logged out successfully.');
    }
}