<?php

spl_autoload_register(function ($class) {
    $classDirectory = dirname(__DIR__) . '\\' . $class . '.php';
    $classDirectory = str_replace('\\', '/', $classDirectory);

    if(file_exists($classDirectory)) {
        require $classDirectory;
    }
});