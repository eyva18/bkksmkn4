<?php

namespace Database\Factories;

use App\Models\AlumniModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusAlumniModel>
 */
class StatusAlumniModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $alumnifactory = AlumniModel::factory(1)->create();
         $alumnidata = $alumnifactory->toArray();
         $bekerja = [1, 2];
         $pendidikan = [1, 2];
         return [
             'nisn' => $alumnidata[0]["NISN"],
             'jurusan' => $alumnidata[0]["kode_jurusanId"],
             'tahun_lulus' => $alumnidata[0]["kode_lulusId"],
             'status_bekerja' => Arr::random($bekerja),
             'status_pendidikan' => Arr::random($pendidikan),
             'universitas' => $this->faker->name,
             'perusahaan' => $this->faker->name,
         ];
    }
}
