<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->student(),
            'nama' => $this->faker->name,
            'nis' => $this->faker->unique()->numerify('##########'),
            'kelas' => $this->faker->randomElement(['10', '11', '12']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
