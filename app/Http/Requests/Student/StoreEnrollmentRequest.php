<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'student';
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'course_id' => [
                'required',
                'integer',
                'exists:courses,id',
            ],
        ];
    }

    /**
     * Custom Validation Messages.
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'Please select a course.',

            'course_id.integer' => 'Invalid course ID.',

            'course_id.exists' => 'The selected course does not exist.',
        ];
    }

    /**
     * Custom Attribute Names.
     */
    public function attributes(): array
    {
        return [
            'course_id' => 'course',
        ];
    }
}