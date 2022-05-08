<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_id' =>rand(1,5),
            'brand_id' => rand(1,10),
            'color_id' => rand(1,10),
            'customer_id' => rand(5,14),
            'license_plate' => $this->faker->unique()->sentence(2),
            'model_year' => $this->faker->year(),
        ];
    }
}
