<?php

namespace Art\View\Renderers;

use Art\Model\Http\Session;

class RegisterPageRenderer
{

    public function __construct()
    {
    }

    public static function createRenderer()
    {
        return new self();
    }

    public function getHeader()
    {
        if(Session::createSession()->getSpecificSession(LOGGED_USER) )
        {
            return require 'src/View/Templates/loggedUserHeader.php';
        }
        return require 'src/View/Templates/defaultHeader.php';
    }

    public function displayPage($errorData = null)
    {
        $this->getHeader();
        $errors = $errorData;
        require 'src/View/Templates/registerForm.php';
    }

}