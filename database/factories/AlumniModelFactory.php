<?php

namespace Database\Factories;

use App\Models\AgamaModel;
use Illuminate\Support\Arr;
use App\Models\JurusanModel;
use App\Models\TahunLulusModel;
use App\Models\JenisKelaminModel;
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
        $jk = [1, 2];
        $agm = [1, 2, 3, 4, 5];
        return [
            'NISN' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'NIS' => $this->faker->randomDigit,
            'nama' => $this->faker->name,
            'no_hp' => $this->faker->randomDigit,
            'biografi' => $this->faker->text,
            'agamaId' => Arr::random($agm),
            'jenis_kelaminId' => Arr::random($jk),
            'alamat' => $this->faker->streetAddress,
            'tempatTanggalLahir' => $this->faker->text,
            'photo_profile' => $this->faker->imageUrl(640,480),
            'transkrip_nilai' => $this->faker->randomDigit,
            'kode_jurusanId' => function () { return JurusanModel::inRandomOrder()->first()->id;},
            'kode_lulusId' => function () { return TahunLulusModel::inRandomOrder()->first()->id;}
        ];
    }
}
