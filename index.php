<?php

use Art\RouterObject\NullURLRouter;

require 'vendor/autoload.php';


     $router = new NullURLRouter('');

    var_dump($router->getControllerRoute());
     call_user_func($router->getControllerRoute());

