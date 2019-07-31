<?php

namespace Art\View\Renderers;

use Art\Model\Http\Request;

require 'src/constants.php';


class LoginPageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public static function createRenderer()
    {
        return new self();
    }

    public function displayPage()
    {
        require 'src/View/Templates/loginForm.php';
    }




}