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
            // 'job_title' => $this->faker->jobTitle,
            // 'description' => $this->faker->text,
            // 'responsibilities' => $this->faker->paragraph,
            // 'required_skills' => $this->faker->words(5, true),
            // 'qualifications' => $this->faker->sentence,
            // 'salary_range' => $this->faker->randomNumber(4) . ' - ' . $this->faker->randomNumber(5),
            // 'benefits_offered' => $this->faker->text,
            // 'location' => $this->faker->city,
            // 'work_type' => $this->faker->randomElement(['full-time', 'part-time', 'freelancing-job']),
            // 'work_from' => $this->faker->randomElement(['remote', 'on-site', 'hybrid']),
            // 'application_deadline' => $this->faker->date,
            // 'user_id' => User::inRandomOrder()->first()->id,
            // 'image' => 'posts/Mocha.jpg',
            
           'job_title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'responsibilities' => $this->faker->paragraph(),
            'required_skills' => $this->faker->sentence(10),
            'qualifications' => $this->faker->sentence(10),
            'benefits_offered' => $this->faker->optional()->paragraph(),
            'location' => $this->faker->city(),
            'work_type' => $this->faker->randomElement(['full-time', 'part-time', 'freelancing-job']),
            'work_from' => $this->faker->randomElement(['remote', 'on-site', 'hybrid']),
            'application_deadline' => $this->faker->date(),
            'user_id' => \App\Models\User::factory(), // Assuming you have a User factory
            'image' => $this->faker->optional()->imageUrl(),
            's_from' => $this->faker->optional()->numberBetween(1000, 5000),
            's_to' => $this->faker->optional()->numberBetween(6000, 10000),
            'status' => 'pended', // Default value

        ];
    }
}
