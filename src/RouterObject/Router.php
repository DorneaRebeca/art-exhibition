<?php

namespace Art\RouterObject;

abstract class Router
{
    private $path;
    private $controllerMethod;
    private $controllerClass;

    public function __construct($path)
    {
        $this->path = $path;
        $this->setControllerProperties();
    }


    /**
     * Sets controllerMethod and controllerClass from path information
     */
    public abstract function setControllerProperties();

    /**
     * Calls the routed method from specific controllerClass
     * @return mixed
     */
    public abstract function callControllerMethod();

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getControllerMethod()
    {
        return $this->controllerMethod;
    }

    /**
     * @param mixed $controllerMethod
     */
    public function setControllerMethod($controllerMethod): void
    {
        $this->controllerMethod = $controllerMethod;
    }

    /**
     * @return mixed
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * @param mixed $controllerClass
     */
    public function setControllerClass($controllerClass): void
    {
        $this->controllerClass = $controllerClass;
    }






}