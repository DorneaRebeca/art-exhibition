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

}