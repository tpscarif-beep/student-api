<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    // Show All Teachers

    public function index()
    {
        $teachers = Teacher::with('user')
            ->withCount('courses')
            ->latest()
            ->get();

        return view('admin.teachers.index', compact('teachers'));
    }


    // Show Create Form

    public function create()
    {
        return view('admin.teachers.create');
    }


    // Store Teacher

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|string|min:8|confirmed',

            'designation' => 'required|string|max:255',

            'department' => 'required|string|max:255',
        ]);


        DB::transaction(function () use ($validated) {

            // Create User

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'teacher',
            ]);


            // Create Teacher Profile

            Teacher::create([
                'user_id' => $user->id,
                'designation' => $validated['designation'],
                'department' => $validated['department'],
            ]);

        });


        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }


    // Show Single Teacher

    public function show(int $id)
    {
        $teacher = Teacher::with([
            'user',
            'courses.enrollments.student.user'
        ])->findOrFail($id);

        return view('admin.teachers.show', compact('teacher'));
    }


    // Show Edit Form

    public function edit(int $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);

        return view('admin.teachers.edit', compact('teacher'));
    }


    // Update Teacher

    public function update(Request $request, int $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($teacher->user_id),
            ],

            'password' => 'nullable|string|min:8|confirmed',

            'designation' => 'required|string|max:255',

            'department' => 'required|string|max:255',
        ]);


        DB::transaction(function () use ($validated, $teacher) {

            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $teacher->user->update($userData);


            $teacher->update([
                'designation' => $validated['designation'],
                'department' => $validated['department'],
            ]);

        });


        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }


    // Delete Teacher

    public function destroy(int $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->user->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}