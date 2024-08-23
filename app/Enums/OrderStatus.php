<?php

namespace App\Enums;

class OrderStatus
{
    const PENDING = 'pending';
    const PAID = 'paid';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';

    public static function getValues()
    {
        return [
            self::PENDING,
            self::PAID,
            self::COMPLETED,
            self::CANCELLED,
        ];
    }
}
