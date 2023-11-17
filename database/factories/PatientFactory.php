<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $addressesIds = DB::table('addresses')->pluck('id');

        return [
            'full_name' => $this->faker->name,
            'mother_full_name' => $this->faker->name('male'),
            'birthday' => $this->faker->date(),
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'cns' => $this->faker->unique()->randomNumber(9),
            'address_id' => $this->faker->randomElement($addressesIds)
        ];
    }
}
