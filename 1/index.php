<?php

function ifElseCompare(int $inputNumber):string {
    if($inputNumber > 30){
        return "More than 30";
    } elseif ($inputNumber > 20){
        return "More than 20";
    } elseif ($inputNumber > 10){
        return "More than 10";
    } else {
        return "Equal or less than 10";
    }
}

//print ifElseCompare(0);

function switchCompare(int $inputNumber){
    switch (true){
        case $inputNumber > 30:
            echo "More than 30";
            break;
        case $inputNumber > 20:
            echo "More than 20";
            break;
        case $inputNumber > 10:
            echo "More than 10";
            break;
        default:
            echo "Equal or less than 10";
    }
}

//switchCompare(-9);

function ternaryCompare(int $inputNumber): string {
    return ($inputNumber > 30)? "More than 30":
        (($inputNumber > 20)? "More than 20":
            (($inputNumber > 10)? "More than 10": "Equal or less than 10"));
}

print ternaryCompare(0);
