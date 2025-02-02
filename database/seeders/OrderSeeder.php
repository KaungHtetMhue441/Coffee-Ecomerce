<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Order::factory()->count(5)->create([
                'user_id' => $user->id,
                'status' => 'pending',
            ]);
        }
    }
}
