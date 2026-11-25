<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Show Student Dashboard

    public function index(Request $request)
    {
        // Get Logged-in Student

        $student = $request->user()
            ->student()
            ->firstOrFail();


        // Total Enrollments

        $totalEnrollments = $student->enrollments()->count();


        // Active Enrollments

        $activeEnrollments = $student->enrollments()
            ->where('status', 'active')
            ->count();


        // Recent Enrolled Courses

        $recentEnrollments = $student->enrollments()
            ->with('course.teacher.user')
            ->latest()
            ->take(5)
            ->get();


        return view('student.dashboard.index', compact(
            'student',
            'totalEnrollments',
            'activeEnrollments',
            'recentEnrollments'
        ));
    }
}