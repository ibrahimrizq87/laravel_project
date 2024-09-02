<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'required_skills' => 'required|string',
            'qualifications' => 'required|string',
            'salary_range' => 'required|string',
            'benefits_offered' => 'nullable|string',
            'location' => 'required|string|max:255',
            'work_type' => 'required|in:full-time,part-time,freelancing-job',
            'work_from' => 'required|in:remote,on-site,hybrid',
            'application_deadline' => 'required|date',
            'date' => 'required|date',
        ];
    }
        public function messages(): array
    {
        return [
            'job_title.required' => 'The job title is required.',
            'job_title.string' => 'The job title must be a string.',
            'job_title.max' => 'The job title may not be greater than 255 characters.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'responsibilities.required' => 'The responsibilities are required.',
            'responsibilities.string' => 'The responsibilities must be a string.',
            'required_skills.required' => 'The required skills are required.',
            'required_skills.string' => 'The required skills must be a string.',
            'qualifications.required' => 'The qualifications are required.',
            'qualifications.string' => 'The qualifications must be a string.',
            'salary_range.required' => 'The salary range is required.',
            'salary_range.string' => 'The salary range must be a string.',
            'benefits_offered.nullable' => 'The benefits offered field is optional.',
            'benefits_offered.string' => 'The benefits offered must be a string.',
            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',
            'work_type.required' => 'The work type is required.',
            'work_type.in' => 'The selected work type is invalid.',
            'work_from.required' => 'The work from is required.',
            'work_from.in' => 'The selected work from is invalid.',
            'application_deadline.required' => 'The application deadline is required.',
            'application_deadline.date' => 'The application deadline must be a valid date.',
            'date.required' => 'The date is required.',
            'date.date' => 'The date must be a valid date.',
           
        ];
    }
}
