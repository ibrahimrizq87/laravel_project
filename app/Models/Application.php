<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'job_id',
        'email',
        'phone_number',
        'resume',
        'additional_information',
        'location',
    ];


    public function resumes()
    {
        return $this->hasOne(Resume::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_id'); // Make sure 'job_id' matches your foreign key column
    }
}

