<?php

use Classes\DTO\Path;
use Classes\Map\Map;
use Classes\PathFindingAlgorithms;
use Classes\Point;

require __DIR__ . '/Classes/autoloader.php';
require __DIR__ . '/mapExamples.php';
require __DIR__ . '/helpers.php';

$map = generateMapOne();
$finder = (new PathFindingAlgorithms\AStar(
    $map,
    new Point(5, 1),
    new Point(5, 5))
);
$path = $finder->findPath();
$path->print();



echo '<br/>';

$map = generateMapTwo();
$finder = (new PathFindingAlgorithms\AStar(
   $map,
   new Point(0, 0),
   new Point(2, 6))
);
$finder->findPath()->print();





