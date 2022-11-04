<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telephone' => $this->faker->phoneNumber(),
            'joined_date' => $this->faker->date(),
            'current_route' => $this->faker->streetAddress(),
            'comments' => $this->faker->regexify('[A-Za-z0-9]{30}')
        ];
    }
}
