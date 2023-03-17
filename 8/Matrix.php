<?php

class Matrix
{
    private int $rowsNumber;
    private int $columnsNumber;

    /**
     * @throws Exception
     */
    public function __construct(private array $coordinates)
    {
        $this->rowsNumber = count($this->coordinates);
        $this->columnsNumber = is_array($this->coordinates[0])
            ? count($this->coordinates[0])
            : throw new Exception('row 1 is not an array');
        $this->verify();
    }

    /**
     * @throws Exception
     */
    private function verify(): void
    {
        if ($this->rowsNumber !== count($this->coordinates)) {
            throw new Exception('Number of rows does not match with rows number variable');
        }

        foreach ($this->coordinates as $rowIndex => $row) {
            if (!is_array($row)) {
                throw new Exception(
                    'row ' . $rowIndex . ' is not an array'
                );
            }

            if ($this->columnsNumber !== count($row)) {
                throw new Exception(
                    'Number of columns in row '
                    . $rowIndex + 1
                    . ' does not match columns number variable'
                );
            }

            foreach ($row as $columnIndex => $element) {
                if (!is_numeric($element)) {
                    throw new Exception('the element with index 
                    [' . $rowIndex . ', ' . $columnIndex . '] is not numeric');
                }
            }
        }
    }

    private function hasEqualSize(self $other): bool
    {
        return ($this->rowsNumber === $other->rowsNumber) && ($this->columnsNumber === $other->columnsNumber);
    }

    /**
     * @throws Exception
     */
    public function add(self $other): self
    {
        if (!$this->hasEqualSize($other)) {
            throw new Exception('You cannot add the matrix with a different size');
        }

        return new self(array_map(function ($thisRow, $otherRow) {

                return array_map(fn($thisElement, $otherElement) => $thisElement + $otherElement,
                    $thisRow, $otherRow
                );
            },
                $this->coordinates, $other->coordinates)
        );
    }

    /**
     * @throws Exception
     */
    public function multiplyByNumber(int|float $number): self {
        return new self(array_map(function ($row) use ($number) {

            return array_map(fn($element) => $element * $number, $row);
        }, $this->coordinates));
    }

    /**
     * @throws Exception
     */
    public function multiplyByMatrix(self $other): self
    {
        if($this->columnsNumber !== $other->rowsNumber) {
            throw new Exception(
                'You cannot multiply two matrices 
                when the number of columns in first and number of rows in second don\'t match'
            );
        }
        $equalRowColumnNumber = $this->columnsNumber;
        $result = [];

        for($row = 0; $row < $this->rowsNumber; $row ++) {
            for($column = 0; $column < $other->columnsNumber; $column ++) {
                $result[$row][$column] = 0;
                for($z = 0; $z < $equalRowColumnNumber; $z ++) {
                    $result[$row][$column] += $this->coordinates[$row][$z] * $other->coordinates[$z][$column];
                }
            }
        }

        return new self($result);
    }

    public function __toString(): string
    {
        $result = '';
        foreach ($this->coordinates as $rowNumber => $row) {
            foreach ($row as $columnNumber => $element) {
                $result .= '[' . $rowNumber + 1 . ', ' . $columnNumber + 1 . '] = ' . $element . ' | ';
            }
            $result .= '</br>';
        }

        return $result;
    }
}