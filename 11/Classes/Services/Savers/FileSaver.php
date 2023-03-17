<?php
namespace Classes\Services\Savers;
class FileSaver implements Saver
{
    public function __construct(private string $basePath = __DIR__)
    {
    }

    public function save(string $name, mixed $data): bool|int
    {
        return file_put_contents($this->basePath . '/' . $name, serialize($data));
    }

    public function load(string $name): mixed
    {
        return unserialize(file_get_contents($this->basePath . '/' . $name));
    }

    public function isSaved(string $name): bool
    {
        return file_exists($this->basePath . '/' . $name);
    }
}