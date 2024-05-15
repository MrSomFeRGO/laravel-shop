<?php

namespace Database\Factories;

use App\Models\DeliveryRegion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryRegionFactory extends Factory
{
    protected $model = DeliveryRegion::class;

    public function definition(): array
    {
        return [
            'name' => fake()->country(),
        ];
    }
}
