<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = [
        'course_name',
        'teacher_id',
    ];

    // Course belongs to One Teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // One Course has Many Enrollments
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}