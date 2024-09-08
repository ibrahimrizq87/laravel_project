<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'skills', 'employed','company','job_description','phone'];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
