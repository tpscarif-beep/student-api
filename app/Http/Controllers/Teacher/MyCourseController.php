<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    // Show My Courses
    public function index(Request $request)
    {
        // Logged-in Teacher
        $teacher = $request->user()
            ->teacher()
            ->firstOrFail();

        // শুধু নিজের Course
        $courses = $teacher->courses()
            ->withCount('enrollments')
            ->latest()
            ->get();

        return view('teacher.courses.index', compact(
            'teacher',
            'courses'
        ));
    }


    // Show Single Course
    public function show(Request $request, int $id)
    {
        // Logged-in Teacher
        $teacher = $request->user()
            ->teacher()
            ->firstOrFail();

        // নিজের Course-এর মধ্য থেকেই নির্দিষ্ট Course খুঁজবে
        $course = $teacher->courses()
            ->withCount('enrollments')
            ->with('enrollments.student.user')
            ->findOrFail($id);

        return view('teacher.courses.show', compact(
            'teacher',
            'course'
        ));
    }
}