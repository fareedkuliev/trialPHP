<?php

function sumNumbers(int $number)
{
    $digits = str_split($number);
    $number = array_sum($digits);
    if (strlen($number) > 1) {
        $number = sumNumbers($number);
    }
    return $number;
}

echo sumNumbers(5689);
