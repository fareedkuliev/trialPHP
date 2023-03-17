<?php
namespace Classes;

use Classes\Exceptions\PointException;
use Classes\Map\ObstaclesMapInterface;

class Point
{
    public function __construct(private int $row, private int $column)
    {
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function __toString(): string
    {
        return '[' . $this->getRow() . ', ' . $this->getColumn() . ']';
    }

    public function up(): static
    {
        return new static($this->getRow() - 1, $this->getColumn());
    }

    public function upLeft(): static
    {
        return $this->up()->left();
    }

    public function upRight(): static
    {
        return $this->up()->right();
    }

    public function down(): static
    {
        return new static($this->getRow() + 1, $this->getColumn());
    }

    public function downLeft(): static
    {
        return $this->down()->left();
    }

    public function downRight(): static
    {
        return $this->down()->right();
    }

    public function right(): static
    {
        return new static($this->getRow(), $this->getColumn() + 1);
    }

    public function left(): static
    {
        return new static($this->getRow(), $this->getColumn() - 1);
    }

    public function equals(Point $point): bool
    {
        return ($this->row === $point->row) && ($this->column === $point->column);
    }

    public function isAttachedTo(Point $point): bool
    {
        if($this->equals($point)) {
            return false;
        }

        return (abs($this->row - $point->row) <= 1) && (abs($this->column - $point->column) <= 1);
    }

    public function leftFrom(Point $point): bool
    {
        return $this->column < $point->column;
    }

    public function rightFrom(Point $point): bool
    {
        return $this->column > $point->column;
    }

    public function upFrom(Point $point): bool
    {
        return $this->row < $point->row;
    }

    public function downFrom(Point $point): bool
    {
        return $this->row > $point->row;
    }

    /**
     * @return Point[]
     */
    public function getSurroundingPoints(): array
    {
       return [
            $this->upLeft(),
            $this->up(),
            $this->upRight(),
            $this->right(),
            $this->downRight(),
            $this->down(),
            $this->downLeft(),
            $this->left(),
        ];
    }

    public function getPassableSurroundingPoints(ObstaclesMapInterface $map): array
    {
        return array_filter(
            $this->getSurroundingPoints(),
            fn(Point $point) => $map->has($point) && !$map->hasObstacle($point)
        );
    }

    public function index(): string
    {
        return $this->row . '.' . $this->column;
    }
}