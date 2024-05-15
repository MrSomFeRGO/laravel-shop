<?php

namespace Database\Factories;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'product_id' => rand(1, 40),
            'quantity' => rand(1, 100),
        ];
    }
}
