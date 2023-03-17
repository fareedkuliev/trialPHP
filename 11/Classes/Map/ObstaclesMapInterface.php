<?php

namespace Classes\Map;
use Classes\Point;

interface ObstaclesMapInterface extends MapInterface
{
    public function hasObstacle(Point $point): bool;
}