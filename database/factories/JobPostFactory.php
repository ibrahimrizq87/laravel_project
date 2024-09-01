<?php

namespace Database\Factories;
use App\Models\User; 

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => $this->faker->jobTitle,
            'description' => $this->faker->text,
            'responsibilities' => $this->faker->paragraph,
            'required_skills' => $this->faker->words(5, true),
            'qualifications' => $this->faker->sentence,
            'salary_range' => $this->faker->randomNumber(4) . ' - ' . $this->faker->randomNumber(5),
            'benefits_offered' => $this->faker->text,
            'location' => $this->faker->city,
            'work_type' => $this->faker->randomElement(['full-time', 'part-time', 'freelancing-job']),
            'work_from' => $this->faker->randomElement(['remote', 'on-site', 'hybrid']),
            'application_deadline' => $this->faker->date,
            'user_id' => User::inRandomOrder()->first()->id,
            'image' => 'posts/Mocha.jpg', 
        ];
    }
}
