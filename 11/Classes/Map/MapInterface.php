<?php

namespace Classes\Map;

use Classes\Point;

interface MapInterface
{
    public function has(Point $point): bool;

    public function get(Point $point): int;

    public function getHtmlElement(Point $point): string;

    public function getRowsNumber(): int;
    public function getColumnsNumber(): int;

    public function equals(self $map): bool;
    public function toArray(): array;
}