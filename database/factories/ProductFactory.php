<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->ean13(),
            'name' => $this->faker->sentence(3),
            'sale_price' => 120,
            'purchase_price' => 100,
            'unit' => $this->faker->randomElement(array('lt','gr','kl')),
            'product_status_id' => rand(1,2),
            'category_product_id' => rand(1,10),
            'brand_product_id' => rand(1,10),
        ];
    }
}
