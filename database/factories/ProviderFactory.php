<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'ruc' => $this->faker->unique()->randomNumber(),
            'name_company' => $this->faker->company(),
            'provider_status_id' => rand(1,2),
        ];
    }
}
