<?php

function rangeTwo(int $a, int $b) {
    if ($a < $b) {
        if ($a == $b) {
            echo $a;
        } else {
            echo $a . ", ";
            rangeTwo($a + 1, $b);
        }
    } else {
        if ($a == $b) {
            echo $a;
        } else {
            echo $a . ", ";
            rangeTwo($a - 1, $b);
        }
    }
}

rangeTwo(7, 12);