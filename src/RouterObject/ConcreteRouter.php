<?php


namespace Art\RouterObject;


class ConcreteRouter extends Router
{
    private const CLASS_INDEX = 1;
    private const METHOD_INDEX = 2;

    /**
     * Sets controllerMethod and controllerClass from path information
     */
    public function setControllerProperties()
    {
        $urlCommands = explode('/', $this->getPath());

        $this->setControllerMethod($urlCommands[self::METHOD_INDEX] );

        $controllerClass = $this->createControllerPath($urlCommands[self::CLASS_INDEX]);

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