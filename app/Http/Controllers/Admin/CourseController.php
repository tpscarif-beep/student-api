<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show All Courses

    public function index()
    {
        $courses = Course::with('teacher.user')
            ->withCount('enrollments')
            ->latest()
            ->get();

        return view('admin.courses.index', compact('courses'));
    }


    // Show Create Form

    public function create()
    {
        $teachers = Teacher::with('user')->get();

        return view('admin.courses.create', compact('teachers'));
    }


    // Store Course

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',

            'teacher_id' => 'required|exists:teachers,id',
        ]);


        Course::create($validated);


        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }


    // Show Single Course

    public function show(int $id)
    {
        $course = Course::with([
            'teacher.user',
            'enrollments.student.user'
        ])->withCount('enrollments')
            ->findOrFail($id);

        return view('admin.courses.show', compact('course'));
    }


    // Show Edit Form

    public function edit(int $id)
    {
        $course = Course::findOrFail($id);

        $teachers = Teacher::with('user')->get();

        return view('admin.courses.edit', compact(
            'course',
            'teachers'
        ));
    }


    // Update Course

    public function update(Request $request, int $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'course_name' => 'required|string|max:255',

            'teacher_id' => 'required|exists:teachers,id',
        ]);


        $course->update($validated);


        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }


    // Delete Course

    public function destroy(int $id)
    {
        $course = Course::findOrFail($id);

        $course->delete();


        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}