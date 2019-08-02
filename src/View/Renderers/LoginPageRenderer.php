<?php

namespace Art\View\Renderers;

use Art\Model\Http\Request;
use Art\Model\Http\Session;


class LoginPageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function getHeader()
    {
        if(Session::createSession()->getSpecificSession(LOGGED_USER) )
        {
            return require 'src/View/Templates/loggedUserHeader.php';
        }
        return require 'src/View/Templates/defaultHeader.php';
    }

    public static function createRenderer()
    {
        return new self();
    }

    /**
     * displays form with or without errors
     * @param null $errorData
     */
    public function displayPage($errorData = null)
    {
        $this->getHeader();
        $errors = $errorData;
        require 'src/View/Templates/loginForm.php';
    }




}