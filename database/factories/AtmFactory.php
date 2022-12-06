<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atm>
 */
class AtmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $faker = Faker::create('id_ID');
        // return [            
        //     'nama_atm' => $faker->company(),
        //     'alamat_atm' => $faker->streetName(),
        //     'kode_mesin' => $faker->numerify('10#########')
        // ];
    }
}
