<?php

namespace Art\Controller;

use Art\Model\Persistence\PersistenceFactory;
use Art\View\Renderers\LoginPageRenderer;
use Art\View\Renderers\ProfilePageRenderer;
use Art\View\Renderers\RegisterPageRenderer;
use Art\Model\DomainObject\User;


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

    /**
     * @var PersistenceFactory;
     */
    private $persistancefactory;


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
        PersistenceFactory::getMapperInstance('user')->insert(new User(null, 'victoria', 'vic@yahoo.com', 'pass'));
        var_dump(PersistenceFactory::getFinderInstance('user')->findAll());
    }

    public function showOrders()
    {

    }

    public function showUploads()
    {

    }



}