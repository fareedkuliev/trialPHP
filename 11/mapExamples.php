<?php

use Classes\Map\Map;
use Classes\Point;

function generateMapOne(): Map
{
    $map = new Map();

    $currentPoint = new Point(4, 2);
    return $map
        ->addObstacle($currentPoint)
        ->addObstacle($currentPoint = $currentPoint->right())
        ->addObstacle($currentPoint->down());
}
function generateMapTwo(): Map
{
    $map = new Map();

    $currentPoint = new Point(1, 1);
    return $map
        ->addObstacle($currentPoint)
        ->addObstacle($currentPoint = $currentPoint->right())
        ->addObstacle($currentPoint = $currentPoint->right())
        ->addObstacle($currentPoint->up())
        ->addObstacle($currentPoint = new Point(2, 2))
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->upRight()->right()->right())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->left())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint = $currentPoint->down())
        ->addObstacle($currentPoint->down());
}