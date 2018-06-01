<?php

    spl_autoload_register(function($className) {
        $classFile = '../src/class/' . $className . '.php';
        if (file_exists($classFile)) {
            require $classFile;
        } else {
            throw new Exception("file {$className}.php not found...");
        }
    });

