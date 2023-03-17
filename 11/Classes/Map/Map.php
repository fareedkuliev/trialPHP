<?php

namespace Classes\Map;

use Classes\Exceptions\MapException;
use Classes\Interfaces\Printable;
use Classes\Point;

class Map implements ObstaclesMapInterface, Printable
{
    const DEFAULT_MAP = [
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    ];

    const DEFAULT_SCALE = 10;


    /**
     * @throws MapException
     */
    public function __construct(
        private array $map = self::DEFAULT_MAP,
        private int   $scale = self::DEFAULT_SCALE,
    )
    {
        $this->verify();
    }

    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * @throws MapException
     */
    private function verify(): void
    {
        if (count($this->map) != $this->scale) {
            throw MapException::incorrectRowsNumber();
        }

        foreach ($this->map as $rowNumber => $row) {
            if (!is_array($row)) {
                throw MapException::rowIsNotArray($rowNumber);
            }

            if (count($row) != $this->scale) {
                throw MapException::elementsDontMatchScale($rowNumber);
            }

            foreach ($row as $columnNumber => $element) {
                if ($element !== 0 && $element !== 1) {
                    throw MapException::incorrectElementValue($rowNumber, $columnNumber);
                }
            }

        }
    }

    /**
     * @throws MapException
     */
    public function addObstacle(Point $point): static
    {
        return $this->changeStatus($point, Status::Obstacle);
    }

    /**
     * @throws MapException
     */
    public function removeObstacle(Point $point): static
    {
        return $this->changeStatus($point, Status::Free);
    }

    /**
     * @throws MapException
     */
    public function changeStatus(Point $point, Status $status): static
    {
        return $this->set($point, $status->value);
    }

    public function get(Point $point): int
    {
        return $this->map[$point->getRow()][$point->getColumn()];
    }

    public function getStatus(Point $point): Status
    {
        return Status::from($this->get($point));
    }

    /**
     * @throws MapException
     */
    public function set(Point $point, int $value): static
    {
        if (!$this->has($point)) {
            throw MapException::coordinateOutOfBound($point);
        }

        $this->map[$point->getRow()][$point->getColumn()] = $value;

        return $this;
    }

    public function has(Point $point): bool
    {
        return isset($this->map[$point->getRow()][$point->getColumn()]);
    }

    public function hasObstacle(Point $point): bool
    {
        return $this->getStatus($point) === Status::Obstacle;
    }

    public function toArray(): array
    {
        return $this->map;
    }

    public function print(): void
    {
        $result = '';
        foreach ($this->map as $rowNumber => $row) {
            foreach ($row as $columnNumber => $element) {
                $result .= $element . ' | ';
            }
            $result .= '</br>';
        }

        echo '<Map>' . $result . '</Map>';
    }

    public function getHtmlElement(Point $point): string
    {
        $element = $this->get($point);

        if($element === 1) {
            return '<span style="background-color: black; color: white">' . $element . '</span>';
        }

        return $element;
    }

    public function getRowsNumber(): int
    {
        return $this->scale;
    }

    public function getColumnsNumber(): int
    {
        return $this->scale;
    }

    public function equals(MapInterface|array|string $map): bool
    {
        if(is_array($map)) {
            return $this->map === $map;
        }

        if(is_string($map)) {
           return json_encode($this->map) === $map;
        }

        return $this->map === $map->map;
    }

    public function index(): string
    {
        return json_encode($this->map);
    }
}