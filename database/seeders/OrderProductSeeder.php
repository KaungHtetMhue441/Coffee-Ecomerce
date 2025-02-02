<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderProductSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $order->products()->attach(
                $products->random(rand(1, 3))->pluck('id')->toArray(),
                [
                    'quantity' => rand(1, 5),
                    'price' => $products->random()->price,
                ]
            );
        }
    }
}
