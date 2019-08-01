<?php


namespace Art\RouterObject;


class ConcreteRouter extends Router
{
    private const CLASS_INDEX = 1;
    private const METHOD_INDEX = 2;
    private const TIER_ID = 3;

    private $tierID = null;

    /**
     * Sets controllerMethod and controllerClass from path information
     */
    public function setControllerProperties()
    {

        $urlCommands = explode('/', $this->getPath());

        $this->setControllerMethod($urlCommands[self::METHOD_INDEX] );

        $controllerClass = $this->createControllerPath($urlCommands[self::CLASS_INDEX]);

        if(sizeof($urlCommands) > 3)
        {
            $this->tierID = $urlCommands[self::TIER_ID];
        }

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


    /**
     * Calls the routed method from specific controllerClass
     * @return mixed
     */
    public function callControllerMethod()
    {
        $controllerClass = $this->getControllerClass();
        $controller = new $controllerClass;
        if($this->tierID)
        {
            $controller->{$this->getControllerMethod()}((int)$this->tierID);
            return;
        }
        $controller->{$this->getControllerMethod()}();
    }
}