<?php


namespace App\Helpers;


class DateTimeHelper
{

    public static function formatDateTime(string $dateTime, $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($dateTime));
    }
}
