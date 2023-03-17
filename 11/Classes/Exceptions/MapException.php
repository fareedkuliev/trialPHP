<?php

namespace Classes\Exceptions;

use Classes\Point;

class MapException extends \Exception
{
    protected $message = 'The Map is incorrect';

    public static function incorrectRowsNumber(): static
    {
        return new self('The number of rows in array is incorrect');
    }

    public static function rowIsNotArray(string $row = ''): static
    {
        return new self('The row ' . $row . 'in the map is not an array');
    }

    public static function elementsDontMatchScale(string $row = ''): static
    {
        return new self('The number of elements in row ' . $row . 'does not match Map scale');
    }

    public static function incorrectElementValue(string $row = '', string $column = ''): static
    {
        $coordinatesMessage = (empty($row) || empty($column)) ? '' : 'with coordinates [' . $row . ', ' . $column . '] ';

        return new self('the element ' . $coordinatesMessage . 'has incorrect value');
    }

    public static function coordinateOutOfBound(?Point $point): static
    {
        $coordinatesMessage = $point ? '' : ' [' . $point->getRow() . ', ' . $point->getColumn() . '] ';

        return new self('the coordinate ' . $coordinatesMessage . 'is out of bound');
    }
}