<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show My Profile
    public function show(Request $request)
    {
        $teacher = $request->user()
            ->teacher()
            ->with('user')
            ->firstOrFail();

        return view('teacher.profile.show', compact('teacher'));
    }


    // Show Edit Profile Page
    public function edit(Request $request)
    {
        $teacher = $request->user()
            ->teacher()
            ->with('user')
            ->firstOrFail();

        return view('teacher.profile.edit', compact('teacher'));
    }


    // Update My Profile
    public function update(Request $request)
    {
        $user = $request->user();

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404);
        }

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'designation' => 'required|string|max:255',

            'department' => 'required|string|max:255',
        ]);

        // Update User Information
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update Teacher Information
        $teacher->update([
            'designation' => $validated['designation'],
            'department' => $validated['department'],
        ]);

        return redirect()
            ->route('teacher.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}