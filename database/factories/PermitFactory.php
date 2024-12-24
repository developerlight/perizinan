<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permit>
 */
class PermitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tanggal_mulai' => $this->faker->date(),
            'keterangan' => $this->faker->text(),
            'img' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['Disetujui', 'Diproses', 'Ditolak']),
        ];
    }
}
