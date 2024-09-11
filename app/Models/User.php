<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isEmployer()
    {
    return $this->role === 'employer';
    }





    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'gender',
        'birthdate'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function resumes()
    {

        // can be updated later to allow more than one resume to be listed in the application

        return $this->hasMany(Resume::class);
    }
    public function applications()
    {

        return $this->hasMany(Application::class);
    }

    public function candidate()
{
    return $this->hasOne(Candidate::class);
}
}
