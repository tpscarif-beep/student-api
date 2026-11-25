<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Course> $courses
 */
class Teacher extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = [
        'user_id',
        'designation',
        'department',
    ];

    // Teacher belongs to one User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // One Teacher has Many Courses
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}