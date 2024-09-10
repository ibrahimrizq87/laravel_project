<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Resume;  
use App\Models\Candidate;  

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $user = $this->route('user'); 

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'birthdate' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => ['nullable','mimes:pdf'],

    

            'skills' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'candidate' && empty($value)) {
                        $fail('The skills field is required when role is candidate.');
                    }
                },
            ],
            'employed' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'candidate' && empty($value)) {
                        $fail('The employed field is required.');
                    }
                },
            ],
            'company' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'candidate' && $this->employed === 'employed' && empty($value)) {
                        $fail('The company field is required .');
                    }
                },
            ],
            'job_description' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'candidate' && $this->employed === 'employed' && empty($value)) {
                        $fail('The job description field is required.');
                    }
                },
            ],
           
            'phone' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'candidate' && empty($value)) {
                        $fail('The phone number field is required .');
                    }
                },
            ],
            'company_name' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'employer' && empty($value)) {
                        $fail('The company name field is required .');
                    }
                },
            ],
            'company_description' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->role === 'employer' && empty($value)) {
                        $fail('The company description field is required .');
                    }
                },
            ],
        ];
    }
}
