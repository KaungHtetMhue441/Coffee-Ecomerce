<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'payment_type' => $this->faker->randomElement(['visa', 'mastercard', 'paypal']),
            'total_amount' => $this->faker->numberBetween(1000, 10000),
            'order_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
