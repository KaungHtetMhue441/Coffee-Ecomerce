<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

interface OrderStatusRepository
{
    public function getByOrderId(int $orderId): Collection;
    public function create(array $data): OrderStatus;
}
