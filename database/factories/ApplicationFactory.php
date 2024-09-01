<?php

namespace Database\Factories;
use App\Models\User; 
use App\Models\JobPost; 

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'job_id' => JobPost::inRandomOrder()->first()->id,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'resume' =>'CVs/cv.pdf', 
            'additional_information' => $this->faker->paragraph,
        ];
    }
}
