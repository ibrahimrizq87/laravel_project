<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'email',
        'phone_number',
        'location',
        'resume_id',
        'additional_information'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class , 'resume_id'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class,'job_id');
    }

}
