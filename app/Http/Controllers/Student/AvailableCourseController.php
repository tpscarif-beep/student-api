<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AvailableCourseController extends Controller
{
    /**
     * Get Authenticated Student
     */
    private function getStudent(): Student
    {
        $user = Auth::user();

        // Check authenticated user
        if (!$user instanceof User) {
            abort(403, 'Unauthenticated user.');
        }

        // Get student profile
        $student = $user->student;

        if (!$student instanceof Student) {
            abort(403, 'Student profile not found.');
        }

        return $student;
    }


    /**
     * Show All Available Courses
     */
    public function index(): View
    {
        $student = $this->getStudent();

        // Get already enrolled course IDs
        $enrolledCourseIds = $student->enrollments()
            ->pluck('course_id');

        // Get courses not enrolled by student
        $courses = Course::with('teacher.user')
            ->whereNotIn('id', $enrolledCourseIds)
            ->latest()
            ->get();

        return view('student.courses.index', compact('courses'));
    }


    /**
     * Show Course Details
     */
    public function show(int $id): View
    {
        $student = $this->getStudent();

        $course = Course::with('teacher.user')
            ->findOrFail($id);

        // Check existing enrollment
        $alreadyEnrolled = $student->enrollments()
            ->where('course_id', $course->id)
            ->exists();

        return view(
            'student.courses.show',
            compact('course', 'alreadyEnrolled')
        );
    }


    /**
     * Enroll Student in Course
     */
    public function store(int $id): RedirectResponse
    {
        $student = $this->getStudent();

        // Find course
        $course = Course::findOrFail($id);

        // Check duplicate enrollment
        $alreadyEnrolled = $student->enrollments()
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with(
                'error',
                'You are already enrolled in this course.'
            );
        }

        // Create enrollment
        DB::transaction(function () use ($student, $course) {
            $student->enrollments()->create([
                'course_id' => $course->id,
                'status' => 'active',
            ]);
        });

        return redirect()
            ->route('student.enrollments.index')
            ->with('success', 'Successfully enrolled in the course.');
    }
}
