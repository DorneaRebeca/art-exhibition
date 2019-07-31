<?php

namespace Art\View\Renderers;

class RegisterPageRenderer
{

    public function __construct()
    {
    }

    public static function createRenderer()
    {
        return new self();
    }

    public function displayPage()
    {
        require 'src/View/Templates/registerForm.php';
    }

}