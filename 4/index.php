<?php
$input = [
    0 => 1,
    1 => 2,
    2 => 3,
    3 => 4,
    4 => 5
];

$position = 3;

$output = removeElement($input, $position);

echo 'input: ' . '<br/>';
echo '<pre>';
print_r($input);
echo '</pre>';
echo '<br/>';
echo 'output: ' . '<br/>';
echo '<pre>';
print_r($output);
echo '</pre>';

function removeElement(array $array, int $position): array
{
    unset($array[$position]);
    $startIndex = 0;
    $endIndex = count($array) - 1;
    var_dump(range($startIndex, $endIndex), $array);

    return array_combine(range($startIndex, $endIndex), $array);
}