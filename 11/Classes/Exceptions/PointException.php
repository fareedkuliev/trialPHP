<?php

namespace Classes\Exceptions;

class PointException extends \Exception
{
    protected $message = 'The point is incorrect';

    public static function coordinateBelowZero(): static
    {
        return new self('The coordinate (row or column) in the point should equal or be more than 0');
    }

    public static function pointsNotAttached(): static
    {
        return new self('Two points are not attached to each other');
    }
}