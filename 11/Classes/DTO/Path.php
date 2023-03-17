<?php

namespace Classes\DTO;

use Classes\Interfaces\Printable;
use Classes\Map\Map;
use Classes\Map\MapInterface;
use Classes\PathPoint\PathPoint;
use Classes\Point;
use Classes\Services\Savers\FileSaver;
use Classes\Services\Savers\Saver;

class Path implements Printable
{
    /**
     * @param MapInterface $map
     * @param Point $start
     * @param Point $end
     * @param PathPoint[] $path
     * @param PathPoint[] $searchedPoints
     */
    public function __construct(
        private MapInterface $map,
        private Point $start,
        private Point $end,
        private array $path,
        private array $searchedPoints
    )
    {
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function getStart(): Point
    {
        return $this->start;
    }

    public function getEnd(): Point
    {
        return $this->end;
    }

    /**
     * @return PathPoint[]
     */
    public function getSearchedPoints(): array
    {
        return $this->searchedPoints;
    }

    /**
     * @return PathPoint[]
     */
    public function toArray(): array
    {
        return $this->path;
    }

    public function print(): void
    {
        $result = '';

        for($rowNumber = 0; $rowNumber < $this->map->getRowsNumber(); $rowNumber++) {
            for($columnNumber = 0; $columnNumber < $this->map->getColumnsNumber(); $columnNumber++) {
                $result .= $this->getHtmlElement(new Point($rowNumber, $columnNumber)) . ' | ';
            }
            $result .= '<br/>';
        }

        echo '<Path>' . $result . '</Path>';
    }

    private function isOnSearchedPathPoint(Point $point): bool
    {
        return isset($this->searchedPoints[$point->index()]) && $this->searchedPoints[$point->index()]->getPoint()->equals($point);
    }

    private function isOnPath(Point $point): bool
    {
        return isset($this->path[$point->index()]) && $this->path[$point->index()]->getPoint()->equals($point);
    }

    private function getHtmlElement(Point $point): string
    {
        $element = $this->map->get($point);

        if($point->equals($this->start)) {
            return '<span style="background-color: blueviolet; color: white">' . $element . '</span>';
        }

        if($point->equals($this->end)) {
            return '<span style="background-color: red; color: white">' . $element . '</span>';
        }

        if($this->isOnPath($point)) {
            return '<span style="background-color: deeppink; color: white">' . $element . '</span>';
        }

        if($this->isOnSearchedPathPoint($point)) {
            return '<span style="background-color: rgba(210,105,30,0.71); color: white">' . $element . '</span>';
        }

        return $this->map->getHtmlElement($point);
    }


    private static function basePath(): string
    {
        return storage_path('/Serialized/DTO/Path');
    }
}