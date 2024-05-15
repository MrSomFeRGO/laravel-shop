<?php

namespace Database\Factories;

use App\Models\Standard;
use Illuminate\Database\Eloquent\Factories\Factory;

class StandardFactory extends Factory
{
    protected $model = Standard::class;

    public function definition(): array
    {
        return [
            'name'=>fake()->word(),
        ];
    }
}
