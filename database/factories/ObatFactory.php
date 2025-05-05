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
            'pendaftar_id' => Pendaftar::factory(), // buat pendaftar otomatis jika belum ada
            'nama' => $this->faker->word . ' ' . $this->faker->randomElement(['Tablet', 'Kapsul', 'Sirup']),
            'tanggal_kedaluwarsa' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
        ];
    }
}
