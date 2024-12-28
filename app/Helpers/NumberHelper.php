<?php


namespace App\Helpers;


class NumberHelper
{
    public static function webFormatFloat(string $str): string
    {
        return number_format($str, 2, ',', '.');
    }

    public static function twoDecimalFormat(int|float $num): float
    {
        return round($num, 2);
    }

 
}
