<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
             'verified'           => 1,
             'verified_at'        => '20/8/2022 12:43:21',
             'verification_token' => '',
             'lastname'           => '',
             'phone'              => ''.random_int(1000000000,9999999999),
             'address'            => '',
             'address_2'          => '',
            'city_id'             => $city=random_int(1,150105),
            'state_id'          => $state=City::find($city)->state_id,
            'country_id'        => State::find($state)->country_id
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
