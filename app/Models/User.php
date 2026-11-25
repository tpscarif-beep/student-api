<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass Assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Hidden Attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute Casting
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // One User has One Student Profile
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    // One User has One Teacher Profile
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }
}