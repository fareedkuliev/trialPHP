<?php

namespace Classes\PathFindingAlgorithms;

use Classes\Exceptions\PointException;
use Classes\Map\ObstaclesMapInterface;
use Classes\PathPoint\PathPoint;
use Classes\PathPoint\Status;
use Classes\Point;
use Classes\DTO\Path;
use Classes\Services\Savers\FileSaver;
use Classes\Services\Savers\Saver;

class AStar implements PathFinder
{
    /**
     * @var PathPoint[]
     */
    private array $searchedPoints = [];

    private Saver $pathSaver;

    public function __construct(
        private ObstaclesMapInterface $map,
        private Point $start,
        private Point $end,
        ?Saver $pathSaver = null
    )
    {
        $this->pathSaver = $pathSaver ?: new FileSaver(storage_path('/Serialized/DTO/Path'));
    }

    private function dataIndex(): string
    {
        return md5(json_encode([
            's' => $this->start->index(),
            'e' => $this->end->index(),
            'm' => $this->map->toArray()
        ]));
    }

    /**
     * @throws PointException
     */
    public function findPath(): Path
    {

        $filename = $this->dataIndex() . '.txt';

        if($this->pathSaver->isSaved($filename)) {
            return $this->pathSaver->load($filename);
        }

        $this->addSurroundedPathPoints();
        $path = $this->extractPathFromSearchPoints($this->searchedPoints);

        $result = new Path($this->map, $this->start, $this->end, $path, $this->searchedPoints);
        $this->pathSaver->save($filename, $result);
        return $result;
    }

    /**
     * @param PathPoint[] $searchedPoints
     * @return PathPoint[]
     */
    private function extractPathFromSearchPoints(array $searchedPoints): array
    {
        $path = [];
        $index = $searchedPoints[$this->end->index()]->getPreviousPointIndex();
        unset($searchedPoints[$this->end->index()]);

        while ($searchedPoints[$index]->getPreviousPointIndex()) {
            $path[$index] = $searchedPoints[$index];
            $index = $searchedPoints[$index]->getPreviousPointIndex();
        }
        return array_reverse($path);
    }

    public function getStartingPoint(): Point
    {
        return $this->start;
    }

    public function getEndingPoint(): Point
    {
        return $this->end;
    }

    public function findDistanceToEnd(Point $point): int
    {
        return (abs($point->getRow() - $this->getEndingPoint()->getRow())
                + abs($point->getColumn() - $this->getEndingPoint()->getColumn())) * 10;
    }
    /**
     * @throws PointException
     */
    public function addSurroundedPathPoints(?PathPoint $previousPathPoint = null): bool
    {
        if(!$previousPathPoint) {
            $previousPathPoint = $this->createStartPathPoint();
        }

        $points = $previousPathPoint->getPoint()->getPassableSurroundingPoints($this->map);

        /** @var Point $point */
        foreach ($points as $point) {
            $newPathPoint = new PathPoint(
                $point,
                $this->findDistanceToEnd($point),
                $previousPathPoint
            );

            //set new pathPoint if no with these coordinates or if existing has more weight
            if(
                !isset($this->searchedPoints[$point->index()])
                || ($this->searchedPoints[$point->index()]->getWeight() > $newPathPoint->getWeight())
            ) {
                $this->searchedPoints[$point->index()] = $newPathPoint;
            }
        }

        $this->searchedPoints[$previousPathPoint->getPoint()->index()]->setStatus(Status::Closed);

        if(!isset($this->searchedPoints[$this->end->index()])) {
            $this->addSurroundedPathPoints($this->findTheLeastWeight());
        }

        return true;
    }

    /**
     * @throws PointException
     */
    private function createStartPathPoint(): PathPoint
    {
        $previousPathPoint = new PathPoint($this->start, 0);
        $this->searchedPoints[$previousPathPoint->getPoint()->index()] = $previousPathPoint;

        return $previousPathPoint;
    }

    private function findTheLeastWeight(): PathPoint
    {
        /** @var PathPoint|null $minPathPoint */
        $minPathPoint = null;
        foreach ($this->searchedPoints as $pathPoint) {
            if(
                $pathPoint->getStatus() === Status::Open
                && (is_null($minPathPoint) || $minPathPoint->getWeight() > $pathPoint->getWeight())
            ) {
                $minPathPoint = $pathPoint;
            }
        }

        return $minPathPoint;
    }

    /**
     * @return PathPoint[]
     */
    public function getCheckedPathPoints(): array
    {
        return $this->searchedPoints;
    }
}