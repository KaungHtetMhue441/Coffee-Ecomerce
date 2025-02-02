<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $statuses = ['pending', 'accepted', 'cooking', 'delivered', 'arrived'];

        foreach ($orders as $order) {
            foreach ($statuses as $status) {
                OrderStatus::create([
                    'order_id' => $order->id,
                    'status' => $status,
                    'updated_at' => now()->addMinutes(rand(1, 60)),
                ]);
            }
        }
    }
}
