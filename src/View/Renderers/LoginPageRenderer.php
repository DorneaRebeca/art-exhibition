<?php

namespace Art\View\Renderers;

use Art\View\Request;

require 'src/constants.php';


class LoginPageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function takeInputs()
    {
        $userEmail = $this->request->getPostSpecific(USER_EMAIL);
        $userPassword = $this->request->getPostSpecific(USER_PASSWORD);
    }

    public function displayPage()
    {
        require 'src/View/Templates/loginForm.php';
    }




}