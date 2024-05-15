<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
//            'title' => fake()->realText(128),
//            'description' => rand(0,1) ? null : fake()->text(400),
//            'certificate_url' => rand(0,1) ? null : Str::slug(fake()->text(64), '-').'.pdf',
//            'conformity_declaration' => rand(0,1) ? null : fake()->text(64),
//            'price' => rand(100000, 9988700) / 100,
//            'price_units' => 'р./кг.',
        ];
    }
}
