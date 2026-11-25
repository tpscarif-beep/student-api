<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    // Show All Enrollments

    public function index()
    {
        $enrollments = Enrollment::with([
            'student.user',
            'course.teacher.user'
        ])
            ->latest()
            ->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }


    // Show Create Form

    public function create()
    {
        $students = Student::with('user')->get();

        $courses = Course::all();

        return view('admin.enrollments.create', compact(
            'students',
            'courses'
        ));
    }


    // Store Enrollment

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',

            'course_id' => [
                'required',
                'exists:courses,id',

                Rule::unique('enrollments', 'course_id')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'student_id',
                            $request->student_id
                        );
                    }),
            ],

            'status' => 'required|in:active,inactive',
        ], [
            'course_id.unique' => 'This student is already enrolled in this course.',
        ]);


        Enrollment::create($validated);


        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment created successfully.');
    }


    // Show Single Enrollment

    public function show(int $id)
    {
        $enrollment = Enrollment::with([
            'student.user',
            'course.teacher.user'
        ])->findOrFail($id);

        return view('admin.enrollments.show', compact('enrollment'));
    }


    // Show Edit Form

    public function edit(int $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $students = Student::with('user')->get();

        $courses = Course::all();

        return view('admin.enrollments.edit', compact(
            'enrollment',
            'students',
            'courses'
        ));
    }


    // Update Enrollment

    public function update(Request $request, int $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',

            'course_id' => [
                'required',
                'exists:courses,id',

                Rule::unique('enrollments', 'course_id')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'student_id',
                            $request->student_id
                        );
                    })
                    ->ignore($enrollment->id),
            ],

            'status' => 'required|in:active,inactive',
        ]);


        $enrollment->update($validated);


        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }


    // Delete Enrollment

    public function destroy(int $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $enrollment->delete();


        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}