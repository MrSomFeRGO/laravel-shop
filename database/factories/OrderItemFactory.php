<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $productId = rand(1, 40);
        $quantity = rand(1, 20);
        return [
            'product_id' => $productId,
            'order_id' => rand(1, 5),
            'quantity' => $quantity,
            'total_price' => round(Product::find($productId)->first()->price * $quantity,2),
        ];
    }
}
