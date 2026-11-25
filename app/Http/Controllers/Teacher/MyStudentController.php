<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class MyStudentController extends Controller
{
    // Show Students Enrolled in My Courses
    public function index(Request $request)
    {
        // Logged-in Teacher
        $teacher = $request->user()
            ->teacher()
            ->firstOrFail();

        // Teacher-এর Course-এ ভর্তি হওয়া Student
        $students = Student::whereHas('enrollments.course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with('user')
            ->withCount([
                'enrollments as my_course_enrollments_count' => function ($query) use ($teacher) {
                    $query->whereHas('course', function ($courseQuery) use ($teacher) {
                        $courseQuery->where('teacher_id', $teacher->id);
                    });
                }
            ])
            ->latest()
            ->get();

        return view('teacher.students.index', compact(
            'teacher',
            'students'
        ));
    }


    // Show Single Student
    public function show(Request $request, int $id)
    {
        // Logged-in Teacher
        $teacher = $request->user()
            ->teacher()
            ->firstOrFail();

        // Student অবশ্যই Teacher-এর অন্তত একটি Course-এ ভর্তি থাকতে হবে
        $student = Student::whereHas('enrollments.course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with('user')
            ->with([
                'enrollments' => function ($query) use ($teacher) {
                    $query->whereHas('course', function ($courseQuery) use ($teacher) {
                        $courseQuery->where('teacher_id', $teacher->id);
                    })->with('course');
                }
            ])
            ->findOrFail($id);

        return view('teacher.students.show', compact(
            'teacher',
            'student'
        ));
    }
}