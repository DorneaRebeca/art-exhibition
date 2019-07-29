<?php

namespace Art\Controller;

use Art\View\Renderers\LoginPageRenderer;
use Art\View\Renderers\ProfilePageRenderer;
use Art\View\Renderers\RegisterPageRenderer;

class UserController
{
    /**
     * @var LoginPageRenderer
     */
    private $loginForm;

    /**
     * @var RegisterPageRenderer
     */
    private $registerForm;
    /**
     * @var ProfilePageRenderer
     */
    private $profileForm;


    public function __construct()
    {

    }

    public function login()
    {
        $this->loginForm = new LoginPageRenderer();
        $this->loginForm->displayPage();
    }

    public function register()
    {
        $this->registerForm= new RegisterPageRenderer();
        $this->registerForm->displayPage();
    }

    public function showProfile()
    {
        $this->profileForm= new ProfilePageRenderer();
        $this->profileForm->displayPage();

    }

    public function logout()
    {

    }

    public function loginPost()
    {

    }

    public function registerPost()
    {

    }

    public function showOrders()
    {

    }

    public function showUploads()
    {

    }



}