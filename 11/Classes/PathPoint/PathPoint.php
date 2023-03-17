<?php

namespace Classes\PathPoint;

use Classes\Exceptions\PointException;
use Classes\Point;

class PathPoint
{
    const STRAIGHT_WAY_NUMBER = 10;
    const DIAGONAL_WAY_NUMBER = 14;
//    public function __construct(private Point $point, private int $wayNumber, private int $distanceToEnd)
//    {
//    }

    private int $wayNumber;
    private ?string $previousPointIndex;
    private Status $status = Status::Open;

    /**
     * @throws PointException
     */
    public function __construct(private Point $point, private int $distanceToEnd, ?PathPoint $previous = null)
    {
        $this->wayNumber = $previous ? $previous->addWayNumber($this->point) : 0;
        $this->previousPointIndex = $previous?->point->index();
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getPreviousPointIndex(): ?string
    {
        return $this->previousPointIndex;
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function getWeight(): int
    {
        return $this->wayNumber + $this->distanceToEnd;
    }

    /**
     * @throws PointException
     */
    public function addWayNumber(Point $point): int
    {
        if(!$this->point->isAttachedTo($point)) {
            throw PointException::pointsNotAttached();
        }

        $wayNumber = ($this->point->getRow() === $point->getRow() || $this->point->getColumn() === $point->getColumn())
            ? self::STRAIGHT_WAY_NUMBER
            : self::DIAGONAL_WAY_NUMBER;

        return $this->wayNumber + $wayNumber;
    }
}