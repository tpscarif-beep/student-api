<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class MyEnrollmentController extends Controller
{
    // Show My Enrollments

    public function index(Request $request)
    {
        // Get Logged-in Student

        $student = $request->user()
            ->student()
            ->firstOrFail();


        // Get Only Own Enrollments

        $enrollments = $student->enrollments()
            ->with([
                'course.teacher.user'
            ])
            ->latest()
            ->get();


        return view('student.enrollments.index', compact('enrollments'));
    }


    // Show Single Enrollment

    public function show(Request $request, int $id)
    {
        // Get Logged-in Student

        $student = $request->user()
            ->student()
            ->firstOrFail();


        // Find Enrollment Belonging to This Student

        $enrollment = $student->enrollments()
            ->with([
                'course.teacher.user'
            ])
            ->findOrFail($id);


        return view('student.enrollments.show', compact('enrollment'));
    }
}