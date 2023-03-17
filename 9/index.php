<?php

class Student
{
    public string $firstName, $lastName, $group;
    public float $averageMark;
    public bool $hasResearchWork;

    public function __construct(String $firstName, String $lastName, String $group, Float $averageMark, Bool $hasResearchWork)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->group = $group;
        $this->averageMark = $averageMark;
        $this->hasResearchWork = $hasResearchWork;
    }

    public function getScholarship(): string
    {
        if( $this->averageMark === 5.0){
            return '100 usd';
        } else {
            return '80 usd';
        }
    }
}

class Aspirant extends Student
{
    public function getScholarship(): string
    {
        if($this->averageMark === 5.0){
            return '200 usd';
        } else {
            return '180 usd';
        }
    }
}

$aspirant = new Aspirant('Faradei', 'Cullio', 'A5', 4.9, true);
$student = $aspirant;

$students = [
    new Student('Frida', 'Kalo', 'A7', 5.0, false),
    new Student('Albert', 'Einstein', 'A8', 4.3, false),
    new Aspirant('Mari', 'Skladovska', 'F1', 5.0, true),
    $student
];

foreach ($students as $student) {
    if ($student->hasResearchWork === true) {
        echo "<pre>" . $student->firstName . " " . $student->lastName . " " . "has some kind of research work." . " Scholarship - " . $student->getScholarship() . "<pre>";
    } else {
        echo "<pre>" . $student->firstName . " " . $student->lastName . " " . "Scholarship - " . $student->getScholarship() . "<pre>";
    }
}
