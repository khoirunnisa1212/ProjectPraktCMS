<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Id_Pendaftar' => $this->faker->randomFloat(1, 30, 120),
            'nama' => $this->faker->word . ' ' . $this->faker->randomElement(['Tita', 'Cia', 'Nina']),
        ];
    }
}
