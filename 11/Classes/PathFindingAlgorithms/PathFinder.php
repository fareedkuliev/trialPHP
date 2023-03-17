<?php

namespace Classes\PathFindingAlgorithms;

use Classes\DTO\Path;
use Classes\PathPoint\PathPoint;
use Classes\Point;

interface PathFinder
{

    public function findPath(): Path;

    /**
     * @return PathPoint[]
     */
    public function getCheckedPathPoints(): array;

    public function getStartingPoint(): Point;
    public function getEndingPoint(): Point;
}