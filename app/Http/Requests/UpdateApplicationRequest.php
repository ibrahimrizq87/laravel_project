<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on authorization needs
    }

    public function rules()
    {
        
        return [
            // 'job_id' => 'required|integer|exists:job_posts,id',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'resume_option' => 'nullable|exists:resumes,id',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'additional_information' => 'nullable|string',
        ];
    }
}

