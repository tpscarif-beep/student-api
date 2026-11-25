<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
            ],
        ];
    }

    /**
     * Custom Validation Messages.
     */
    public function messages(): array
    {
        return [
            'course_name.required' => 'Course name is required.',

            'teacher_id.required' => 'Please select a teacher.',
            'teacher_id.integer' => 'Invalid teacher ID.',
            'teacher_id.exists' => 'The selected teacher does not exist.',
        ];
    }
}