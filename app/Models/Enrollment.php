<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = [
        'student_id',
        'course_id',
        'status',
    ];

    // Enrollment belongs to One Student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Enrollment belongs to One Course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}