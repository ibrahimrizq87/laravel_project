<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_title',
        'description',
        'responsibilities',
        'required_skills',
        'qualifications',
        'salary_range',
        'benefits_offered',
        'location',
        'work_type',
        'work_from',
        'application_deadline',
        'date',
         'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
