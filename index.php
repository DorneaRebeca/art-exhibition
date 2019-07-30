<?php

use Art\Controller\UserController;
use Art\RouterObject\ConcreteRouter;
use Art\RouterObject\NullURLRouter;

require 'vendor/autoload.php';
ini_set('display_errors', 'ON');
$config = include 'src/config.php';

    if( strlen($_SERVER['REQUEST_URI']) <= 1)
    {
        $router = new NullURLRouter($_SERVER['REQUEST_URI']);
    }

    if( strlen($_SERVER['REQUEST_URI']) > 1 )
    {
        $router = new ConcreteRouter($_SERVER['REQUEST_URI']);
    }

    $controllerClass = $router->getControllerClass();

    $controller = new $controllerClass;

    $controller->{$router->getControllerMethod()}();







