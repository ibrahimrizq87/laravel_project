<?php




namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on authorization needs
    }

    public function rules()
    {
        
        return [
            'job_id' => 'required|integer|exists:job_posts,id',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'additional_information' => 'nullable|string',
            'resume_option' => 'required_without:resume|exists:resumes,id',
            'resume' => 'required_without:resume_option|file|mimes:pdf|max:2048',
        ];
    }
}
