<?php

namespace App\Enums;

class OrderStatus
{
    const PENDING = 'pending';
    const ACCEPTED = 'accepted';
    const ARRIVED = 'arrived';
    const REJECTED = 'rejected';

    public static function getValues()
    {
        return [
            self::PENDING,
            self::ACCEPTED,
            self::ARRIVED,
            self::REJECTED
        ];
    }
}
