<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition()
    {
        return [
            'title'   => $this->faker->unique()->jobTitle(),
            'content' => $this->faker->realText(),
        ];
    }
}
