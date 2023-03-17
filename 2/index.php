<?php

function birthdayCountdown(string $date)
{

    $dateFormat = 'd-m-Y';
    $birthday = DateTime::createFromFormat($dateFormat, $date);
    if (!$birthday || $birthday->format($dateFormat) !== $date) {
        echo "The date is incorrect";
        return die();
    }

    $dateToday = new DateTime(date($dateFormat));

    if ($dateToday < $birthday) {
        throw new Exception("You are not born yet");
    }

    $dateModify = substr($date, 0, 5);

    $newDateFormat = 'd-m';
    $birthdayUpdate = DateTime::createFromFormat($newDateFormat, $dateModify);

    if ($dateToday > $birthdayUpdate) {

        $birthdayUpdate = $birthdayUpdate->modify('+1 year');

    }

    $dateToday = new DateTime(date($dateFormat));

    return $birthdayUpdate->diff($dateToday)->days;

}

echo birthdayCountdown('18-04-2022');



