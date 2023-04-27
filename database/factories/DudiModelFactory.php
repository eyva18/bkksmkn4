<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DudiModel>
 */
class DudiModelFactory extends Factory
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
            'bidang' => $this->faker->name,
            'no_telp' => $this->faker->randomDigit,
            'deskripsi' => $this->faker->text,
            'alamat' => $this->faker->streetAddress,
            'logo' => "ph.png",
        ];
    }
}
