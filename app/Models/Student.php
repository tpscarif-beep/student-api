<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = [
        'user_id',
        'department',
        'status',
    ];

    // Student belongs to One User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // One Student has Many Enrollments
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}