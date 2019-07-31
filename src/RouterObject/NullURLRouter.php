<?php


namespace Art\RouterObject;


class NullURLRouter extends Router
{
    /**
     * Sets controllerMethod and controllerClass from path information
     */
    public function setControllerProperties()
    {
        $this->setControllerClass('Art\Controller\ProductController');
        $this->setControllerMethod('showProducts');
    }

    /**
     * Calls the routed method from specific controllerClass
     * @return mixed
     */
    public function callControllerMethod()
    {
        $controllerClass = $this->getControllerClass();

        $controller = new $controllerClass;

        $controller->{$this->getControllerMethod()}();
    }
}