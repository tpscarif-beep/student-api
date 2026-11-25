<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
            ],

            'role' => [
                'required',
                'in:admin,teacher,student',
            ],
        ];
    }

    /**
     * Custom Validation Messages.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',

            'password.required' => 'Password is required.',

            'role.required' => 'Please select your role.',
            'role.in' => 'Selected role is invalid.',
        ];
    }

    /**
     * Custom Validation Attribute Names.
     */
    public function attributes(): array
    {
        return [
            'email' => 'email address',
            'password' => 'password',
            'role' => 'user role',
        ];
    }
}