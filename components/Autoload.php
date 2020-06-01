<?php

spl_autoload_register(function ($class_name) {
    $arrayPaths = array(
        '/models/',
        '/components/',
        '/controllers/'
    );

    foreach ($arrayPaths as $path) 
    {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            require_once $path;
        }
    }
//    include 'classes/' . $class_name . '.class.php';
});