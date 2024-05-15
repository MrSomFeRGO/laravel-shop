<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $orderStatuses = [OrderStatus::DELIVERED->value, OrderStatus::DELIVERING->value, OrderStatus::PAYABLE->value,];
        return [
            'user_id' => 1,
            'user_address_id' => rand(1, 5),
            'total_price' => 0,
            'status' => $orderStatuses[rand(0, 2)],
            'payment_method' => rand(1, 2) == 1 ? PaymentMethod::CARD->value : PaymentMethod::CASH->value,
        ];
    }
}
