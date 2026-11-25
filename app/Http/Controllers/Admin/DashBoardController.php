<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics

        $totalStudents = Student::count();

        $totalTeachers = Teacher::count();

        $totalCourses = Course::count();

        $totalEnrollments = Enrollment::count();


        // Recent Students

        $recentStudents = Student::with('user')
            ->latest()
            ->take(5)
            ->get();


        // Recent Enrollments

        $recentEnrollments = Enrollment::with([
            'student.user',
            'course.teacher.user'
        ])
            ->latest()
            ->take(5)
            ->get();


        // Course-wise Student Count

        $courses = Course::with('teacher.user')
            ->withCount('enrollments')
            ->latest()
            ->take(5)
            ->get();


        return view('admin.dashboard.index', compact(
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalEnrollments',
            'recentStudents',
            'recentEnrollments',
            'courses'
        ));
    }
}