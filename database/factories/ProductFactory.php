<?php

namespace Database\Factories;

use App\Models\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'code'        => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'name'        => $this->faker->unique()->jobTitle(),
            'price'       => $this->faker->randomNumber(),
            'description' => $this->faker->realText(),
            'maker_id'    => Maker::query()->inRandomOrder()->value('id'),
        ];
    }
}
