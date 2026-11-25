<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Teacher;

class ReportController extends Controller
{
    public function index()
    {
        // Total Enrollments
        $totalEnrollments = Enrollment::count();

        // Active Enrollments
        $activeEnrollments = Enrollment::where('status', 'active')->count();

        // Inactive Enrollments
        $inactiveEnrollments = Enrollment::where('status', 'inactive')->count();

        // Course Statistics
        $courses = Course::with([
            'teacher.user'
        ])
        ->withCount('enrollments')
        ->latest()
        ->get();

        // Teacher Statistics
        $teachers = Teacher::with('user')
            ->withCount('courses')
            ->latest()
            ->get();

        // Recent Enrollments
        $recentEnrollments = Enrollment::with([
            'student.user',
            'course.teacher.user'
        ])
        ->latest()
        ->take(10)
        ->get();

        // Return Report View
        return view('admin.reports.index', compact(
            'totalEnrollments',
            'activeEnrollments',
            'inactiveEnrollments',
            'courses',
            'teachers',
            'recentEnrollments'
        ));
    }
}