<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandVehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_vehicle' => $this->faker->randomElement(array('suzuki','toyota','nissan','kia','hyundai','honda','chevrolet')),
            'type_brand_id' => rand(1,5),
        ];
    }
}
