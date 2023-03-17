<?php

function birthdayCountdown(string $date){

    $dateFormat = 'd-m-Y';
    $birthday = DateTime::createFromFormat($dateFormat, $date);
    if(!$birthday || $birthday->format($dateFormat) !== $date){
        echo "The date is incorrect";
        return die();
    }

    $dateTodaySplit = explode('-', date('d-m-Y'));
    $birthdaySplit = explode('-', $date);
    if($dateTodaySplit[2] > $birthdaySplit[2] || ($dateTodaySplit[2] === $birthdaySplit[2] &&
            $dateTodaySplit[1] > $birthdaySplit[1]) || ($dateTodaySplit[2] === $birthdaySplit[2] &&
            $dateTodaySplit[1] === $birthdaySplit[1] && $dateTodaySplit[0] > $birthdaySplit[0])){
        echo 'Your birthday has passed';
        return die();
    }

    $dateToday = new DateTime(date('d-m-Y'));
    $days = $birthday->diff($dateToday);

    return $days->days;
}

print birthdayCountdown('13-12-2034');



