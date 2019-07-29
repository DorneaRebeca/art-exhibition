<?php


namespace Art\RouterObject;


class ConcreteRouter extends Router
{
    /**
     * Sets controllerMethod and controllerClass from path information
     */
    public function setControllerProperties()
    {
        $urlCommands = explode('/', $this->getPath());

        $this->setControllerMethod($urlCommands[sizeof($urlCommands) - 1]);

        $controllerClass = $this->createControllerPath($urlCommands[sizeof($urlCommands) - 2]);

        $this->setControllerClass($controllerClass);

    }

    private function createControllerPath($urlProperty) : string
    {
        if(strstr($urlProperty, 'user'))
            return  'Art\\Controller\\UserController';

        if(strstr($urlProperty, 'product'))
            return  'Art\\Controller\\ProductController';
        return '';
    }


}