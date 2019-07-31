<?php

namespace Art\Controller;

use Art\Model\FormMapper\LoginFormMapper;
use Art\Model\FormMapper\RegisterFormMapper;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\View\Renderers\HomePageRenderer;
use Art\View\Renderers\LoginPageRenderer;
use Art\View\Renderers\ProfilePageRenderer;
use Art\View\Renderers\RegisterPageRenderer;



class UserController
{
    private const LOGGED_USER = 'loggedUser';
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
     * @var HomePageRenderer
     */
    private  $homePageForm;

    /**
     * @var Session
     */
    private $session;

    private $request;


    public function __construct()
    {
        $this->homePageForm = HomePageRenderer::createRenderer();
        $this->loginForm = LoginPageRenderer::createRenderer();
        $this->registerForm= RegisterPageRenderer::createRenderer();
        $this->profileForm= ProfilePageRenderer::createRenderer();

        $this->request = Request::createRequest();

    }

    public function login()
    {
        $this->loginForm->displayPage();
    }

    public function register()
    {
        $this->registerForm->displayPage();
    }

    public function showProfile()
    {
        $uploads = $this->getUploads();
        $this->profileForm->displayPage($uploads);
    }

    public function logout()
    {
        $session =Session::createSession();
        $session->abortSession();

        header('Location:/');

    }

    public function loginPost()
    {

        $mapper = new LoginFormMapper($this->request);
        $user = $mapper->getUserFromLoginForm();

        if($user = PersistenceFactory::getFinderInstance('user')->findByEmail($user->getEmail()))
        {
            $this->session = Session::createSession();
            $this->session->setSessionData(self::LOGGED_USER, $user->getId());

            $this->showProfile();
        }
    }

    public function registerPost()
    {
        $mapper = new RegisterFormMapper($this->request);

        //TODO : validations : passwords match, account already exists, email

        $registeredUser = $mapper->getUserFromLoginForm();

        PersistenceFactory::getMapperInstance('user')->insert($registeredUser);
        echo 'You have been registered successfully! Sign in to experience our world!'.PHP_EOL;
        $this->loginForm->displayPage();
    }

    public function getOrders()
    {

    }

    private function getUploads()
    {
        if(isset($this->session))
        {
            $userUploadProducts = PersistenceFactory::getFinderInstance('product')
                ->findUserProducts($this->session
                                        ->getSpecificSession(self::LOGGED_USER));

            return $userUploadProducts;
        }

        return null;

    }

}