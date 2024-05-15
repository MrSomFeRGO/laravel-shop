<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'region' => 'Брестская',
            'country' => fake()->country(),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'zipcode' => fake()->postcode(),
            'fio' => fake()->firstName('female') . ' ' . fake()->lastName('female'),
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
