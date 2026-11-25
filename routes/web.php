<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

// Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\MyCourseController;
use App\Http\Controllers\Teacher\MyStudentController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;

// Student Controllers
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\AvailableCourseController;
use App\Http\Controllers\Student\MyEnrollmentController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return redirect()->route('login');
});


// Guest Routes
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');


    // Student Registration
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');

});


// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        // Student Management
        Route::resource('students', AdminStudentController::class);


        // Teacher Management
        Route::resource('teachers', AdminTeacherController::class);


        // Course Management
        Route::resource('courses', AdminCourseController::class);


        // Enrollment Management
        Route::resource('enrollments', AdminEnrollmentController::class)
            ->except(['create', 'store']);


        // Reports
        Route::get('/reports', [AdminReportController::class, 'index'])
            ->name('reports.index');

    });



/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])
            ->name('dashboard');


        // My Courses
        Route::get('/courses', [MyCourseController::class, 'index'])
            ->name('courses.index');

        Route::get('/courses/{id}', [MyCourseController::class, 'show'])
            ->name('courses.show');


        // My Students
        Route::get('/students', [MyStudentController::class, 'index'])
            ->name('students.index');

        Route::get('/students/{id}', [MyStudentController::class, 'show'])
            ->name('students.show');


        // Teacher Profile
        Route::get('/profile', [TeacherProfileController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/edit', [TeacherProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [TeacherProfileController::class, 'update'])
            ->name('profile.update');

    });



/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');


        // Available Courses
        Route::get('/courses', [AvailableCourseController::class, 'index'])
            ->name('courses.index');

        Route::get('/courses/{id}', [AvailableCourseController::class, 'show'])
            ->name('courses.show');

        Route::post('/courses/{id}/enroll', [AvailableCourseController::class, 'store'])
            ->name('courses.enroll');


        // My Enrollments
        Route::get('/my-enrollments', [MyEnrollmentController::class, 'index'])
            ->name('enrollments.index');


        // Student Profile
        Route::get('/profile', [StudentProfileController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/edit', [StudentProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [StudentProfileController::class, 'update'])
            ->name('profile.update');

    });