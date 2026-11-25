<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    // Teacher Dashboard
    public function index(Request $request)
    {
        // Logged-in Teacher-এর Profile বের করা
        $teacher = $request->user()
            ->teacher()
            ->firstOrFail();

        // Teacher-এর মোট Course
        $totalCourses = $teacher->courses()->count();

        // Teacher-এর Course-এ মোট Enrollment
        $totalEnrollments = Enrollment::whereHas('course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->count();

        // Active Enrollment
        $activeEnrollments = Enrollment::where('status', 'active')
            ->whereHas('course', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })
            ->count();

        // Inactive Enrollment
        $inactiveEnrollments = Enrollment::where('status', 'inactive')
            ->whereHas('course', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })
            ->count();

        // Teacher-এর নিজের Course-গুলোর সাম্প্রতিক Enrollment
        $recentEnrollments = Enrollment::whereHas('course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with(['student.user', 'course'])
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard.index', compact(
            'teacher',
            'totalCourses',
            'totalEnrollments',
            'activeEnrollments',
            'inactiveEnrollments',
            'recentEnrollments'
        ));
    }
}