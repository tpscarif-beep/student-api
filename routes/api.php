<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Register
Route::post('/register', [AuthController::class, 'register']);

// Authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Course

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/courses', [CourseController::class, 'store']);

    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::put('/courses/{id}', [CourseController::class, 'update']);

    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

});

// Enrollment
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/enrollments', [EnrollmentController::class, 'store']);

    Route::get('/enrollments', [EnrollmentController::class, 'index']);

    Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);

});

//Teacher

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/teachers', [TeacherController::class, 'store']);

    Route::get('/teachers', [TeacherController::class, 'index']);

    Route::get('/teachers/{id}', [TeacherController::class, 'show']);

    Route::put('/teachers/{id}', [TeacherController::class, 'update']);

    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);

});

//Student


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/students', [StudentController::class, 'store']);

    Route::get('/students', [StudentController::class, 'index']);

    Route::get('/students/{id}', [StudentController::class, 'show']);

    Route::put('/students/{id}', [StudentController::class, 'update']);

    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

});

