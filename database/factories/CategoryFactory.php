<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'code'      => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'name'      => $this->faker->unique()->jobTitle(),
            'parent_id' => $this->faker->randomElement([null, 1, 2]),
        ];
    }
}
