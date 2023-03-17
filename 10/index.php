<?php

class MyCalculator
{
    protected $a, $b, $result;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function add()
    {
        $this->result = $this->a + $this->b;
        return $this;
    }

    public function subtract()
    {
        $this->result = $this->a - $this->b;
        return $this;
    }

    public function multiple()
    {
        $this->result = $this->a * $this->b;
        return $this;
    }

    public function divide()
    {
        if($this->b !== 0){
            $this->result = $this->a / $this->b;
            return $this;
        } else {
            return $this->result = "Impossible to divide by zero";
        }
    }

    public function addBy($c): string
    {
        $this->result = $this->result + $c;
        return $this->result;
    }

    public function subtractBy($c): string
    {
        $this->result = $this->result - $c;
        return $this->result;
    }

    public function multipleBy($c): string
    {
        $this->result = $this->result * $c;
        return $this->result;
    }

    public function divideBy($c): string
    {
        if($c !== 0){
            $this->result = $this->result / $c;
        } else {
            $this->result = "Impossible divide by zero";
        }
        return $this->result;
    }
}

$myCalc = new MyCalculator(4, 2);
echo $myCalc->add()->addBy(7);
echo $myCalc->add();


