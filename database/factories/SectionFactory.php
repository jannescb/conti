<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['text', 'quote', 'block']),
            'parent_id' => $this->faker->numberBetween(1, 10),
            'parent_type' => $this->faker->randomElement([
                'App\Models\Page',
                'App\Models\Section',
            ]),
            'order_column' => $this->faker->numberBetween(1, 10),
        ];
    }
}
