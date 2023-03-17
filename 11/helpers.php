<?php
const TASK_ROOT = __DIR__;
function storage_path(string $path): string
{
    return TASK_ROOT . '/storage' . $path;
}