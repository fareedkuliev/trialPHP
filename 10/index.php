<?php

class MyCalculator
{
    protected float $a, $b, $result;

    public function __construct(float $a, float $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function add(): static
    {
        $this->result = $this->a + $this->b;

        return $this;
    }

    public function subtract(): static
    {
        $this->result = $this->a - $this->b;

        return $this;
    }

    public function multiple(): static
    {
        $this->result = $this->a * $this->b;

        return $this;
    }

    public function divide(): static
    {
        $this->result = $this->a / $this->b;

        return $this;
    }

    public function addBy(float $c): static
    {
        $this->result = $this->result + $c;

        return $this;
    }

    public function subtractBy(float $c): static
    {
        $this->result = $this->result - $c;

        return $this;
    }

    public function multipleBy(float $c): static
    {
        $this->result = $this->result * $c;

        return $this;
    }

    public function divideBy(float $c): static
    {
        $this->result = $this->result / $c;

        return $this;
    }

    public function __toString(): string
    {
        return $this->result;
    }
}

$myCalc = new MyCalculator(4, 2);
echo $myCalc->add()->addBy(7)->divideBy(0);
//echo $myCalc->add();




