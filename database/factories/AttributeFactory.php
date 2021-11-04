<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'section_id' => $this->faker->numberBetween(1, 10),
            'type' => $this->faker->randomElement(['text', 'number']),
            'key' => $this->faker->randomElement(['text', 'quote', 'name']),
            'value' => $this->faker->text(),
        ];
    }
}
