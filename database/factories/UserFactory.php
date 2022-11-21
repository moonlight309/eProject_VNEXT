<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name'     => $this->faker->name(),
            'email'    => $this->faker->unique()->email(),
            'password' => $this->faker->password(),
            'birthday' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
            'role'     => $this->faker->randomElement([1]),
            'phone'    => $this->faker->phoneNumber(),
        ];
    }

    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
