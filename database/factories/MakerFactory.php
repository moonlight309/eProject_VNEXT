<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MakerFactory extends Factory
{
    public function definition()
    {
        return [
            'code'        => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'name'        => $this->faker->company(),
            'address'     => $this->faker->address(),
            'phone'       => $this->faker->phoneNumber(),
            'description' => $this->faker->realText(),
        ];
    }
}
