<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show Own Profile

    public function show(Request $request)
    {
        $student = $request->user()
            ->student()
            ->with('user')
            ->firstOrFail();


        return view('student.profile.show', compact('student'));
    }


    // Show Edit Profile Form

    public function edit(Request $request)
    {
        $student = $request->user()
            ->student()
            ->with('user')
            ->firstOrFail();


        return view('student.profile.edit', compact('student'));
    }


    // Update Own Profile

    public function update(Request $request)
    {
        $student = $request->user()
            ->student()
            ->firstOrFail();


        // Validate Data

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($student->user_id),
            ],

            'department' => 'required|string|max:255',

        ]);


        // Update User Information

        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);


        // Update Student Information

        $student->update([
            'department' => $validated['department'],
        ]);


        return redirect()
            ->route('student.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}