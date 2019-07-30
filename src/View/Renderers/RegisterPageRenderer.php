<?php


namespace Art\View\Renderers;

use Art\View\Request;

class RegisterPageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function displayPage()
    {
        require 'src/View/Templates/registerForm.php';
    }

}