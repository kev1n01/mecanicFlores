<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider_id' => rand(1,10),
            'user_id' => rand(1,14),
            'total' => $this->faker->numberBetween(50,2000),
            'code_purchase' => $this->faker->ean13(),
            'date_purchase' => now(),
            'observation' => $this->faker->text(50),
            'status' => rand(1,5),
        ];
    }
}
