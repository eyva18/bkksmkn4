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
        // $alumnifactory = AlumniModel::factory(1)->create();
        // $alumnidata = $alumnifactory->toArray();
        // $bekerja = ['bekerja','tidak bekerja'];
        // $pendidikan = ['melanjutkan pendidikan','tidak melanjutkan pendidikan'];
        // return [
        //     'nisn_alumni' => $alumnidata[0]["NISN"],
        //     'bekerja' => Arr::random($bekerja),
        //     'pendidikan' => Arr::random($pendidikan),
        //     'universitas' => $this->faker->name,
        //     'perusahaan' => $this->faker->name,
        // ];
    }
}
