<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

class OrderStatusRepositoryImpl implements OrderStatusRepository
{
    public function getByOrderId(int $orderId): Collection
    {
        return OrderStatus::where('order_id', $orderId)->orderBy('created_at')->get();
    }

    public function create(array $data): OrderStatus
    {
        return OrderStatus::create($data);
    }
}
