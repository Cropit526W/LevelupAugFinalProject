<?php

include_once '..' . DIRECTORY_SEPARATOR . 'config.example.php';

/**
 * Returns the url of the route
 * @param $controller
 * @param $action
 * @return string
 */
function url($controller = null, $action = null) : string
{
    return \app\core\Route::url($controller, $action);
}

/**
 * Register a function with the spl provided __autoload queue. If the queue is not yet activated it will be activated
 */
spl_autoload_register(function ($class){

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classFile = '..'.DIRECTORY_SEPARATOR.$class . '.php';

    if (file_exists($classFile)) {
        include_once $classFile;
        return true;
    }

    return false;

});

/**
 * Route initialization
 */
\app\core\Route::init();