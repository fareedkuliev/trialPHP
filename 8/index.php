<?php

require __DIR__ . '/Matrix.php';

$first = new Matrix([
   [1, 2, 3],
   [4, 5, 6]
]);

$second = new Matrix([
    [6, 7, 8],
    [9, 10, -1.5]
]);

echo $first;
echo '</br>';
echo $second;
echo '</br>';
echo $third = $first->add($second);
echo '</br>';
echo $third->multiplyByNumber(-2);
echo '</br>';

$fourth = new Matrix([
    [1, 2, 4],
    [0, 3, 6]
]);

$fifth = new Matrix([
    [-1, 4, 4, 5],
    [-2, 5, 10, 18],
    [-10, 7, 3, 0.3]
]);

echo $fourth->multiplyByMatrix($fifth);