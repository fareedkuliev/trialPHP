<?php

namespace Classes\Services\Savers;

interface Saver
{
    public function save(string $name, mixed $data): bool|int;

    public function load(string $name): mixed;

    public function isSaved(string $name): bool;
}