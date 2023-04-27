<?php

namespace Database\Factories;

use App\Models\JurusanModel;
use App\Models\TahunLulusModel;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlumniModel>
 */
class AlumniModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jkpick = ['laki-laki', 'perempuan'];
        return [
            'NISN' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'NIS' => $this->faker->randomDigit,
            'nama' => $this->faker->name,
            'no_hp' => $this->faker->randomDigit,
            'biografi' => $this->faker->text,
            'agama' => "Islam",
            'jk' => $jkpick[rand(0,1)],
            'alamat' => $this->faker->streetAddress,
            'TTL' => $this->faker->text,
            'photo_profile' => $this->faker->imageUrl(640,480),
            'transkrif_nilai' => $this->faker->randomDigit,
            'kode_jurusan' => function () { return JurusanModel::inRandomOrder()->first()->id;},
            'kode_lulus' => function () { return TahunLulusModel::inRandomOrder()->first()->id;}
        ];
    }
}
