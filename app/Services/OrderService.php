<?php

namespace App\Services;

use Str;

class OrderService
{

    /**
     * Convert the given status name to status code
     *
     * @params string
     * @return integer
     */
    public static function toStatusCode($statusName)
    {
        $statusName = Str::slug($statusName);

        switch ($statusName) {
            case 'pending':
            case 'pending-payment':
                return 1;
            case 'completed':
                return 2;
            case 'failed':
                return 3;
            default:
                return null;
        }
    }

    /**
     * Convert the given status code to status name
     *
     * @params integer
     * @return string
     */
    public static function toStatusName(int $statusCode)
    {
        switch ($statusCode) {
            case 1:
                return 'Pending Payment';
            case 2:
                return 'Completed';
            case 3:
                return 'Failed';
            default:
                return null;
        }
    }
}
