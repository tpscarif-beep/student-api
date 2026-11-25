<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // Show All Students

    public function index()
    {
        $students = Student::with('user')
            ->latest()
            ->get();

        return view('admin.students.index', compact('students'));
    }


    // Show Create Form

    public function create()
    {
        return view('admin.students.create');
    }


    // Store Student

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|string|min:8|confirmed',

            'department' => 'required|string|max:255',

            'status' => 'required|in:active,inactive',
        ]);


        DB::transaction(function () use ($validated) {

            // Create User

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student',
            ]);


            // Create Student Profile

            Student::create([
                'user_id' => $user->id,
                'department' => $validated['department'],
                'status' => $validated['status'],
            ]);

        });


        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }


    // Show Single Student

    public function show(int $id)
    {
        $student = Student::with([
            'user',
            'enrollments.course.teacher.user'
        ])->findOrFail($id);

        return view('admin.students.show', compact('student'));
    }


    // Show Edit Form

    public function edit(int $id)
    {
        $student = Student::with('user')->findOrFail($id);

        return view('admin.students.edit', compact('student'));
    }


    // Update Student

    public function update(Request $request, int $id)
    {
        $student = Student::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($student->user_id),
            ],

            'password' => 'nullable|string|min:8|confirmed',

            'department' => 'required|string|max:255',

            'status' => 'required|in:active,inactive',
        ]);


        DB::transaction(function () use ($validated, $student) {

            // Update User Information

            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $student->user->update($userData);


            // Update Student Information

            $student->update([
                'department' => $validated['department'],
                'status' => $validated['status'],
            ]);

        });


        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }


    // Delete Student

    public function destroy(int $id)
    {
        $student = Student::findOrFail($id);

        $student->user->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}