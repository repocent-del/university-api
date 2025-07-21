<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'degree' => $this->faker->randomElement(['PhD', 'MSc', 'BSc', 'MA']),
            'join_at' => $this->faker->date('Y-m-d', 'now'),
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
