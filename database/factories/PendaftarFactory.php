<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendaftar>
 */
class PendaftarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-10 years'),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'bb' => $this->faker->randomFloat(1, 30, 120), // berat badan antara 30 - 120 kg
            'tb' => $this->faker->randomFloat(1, 100, 200), // tinggi badan 100 - 200 cm
            'telepon' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}