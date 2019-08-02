<?php

namespace Art\Controller;

use Art\Model\FormMapper\LoginFormMapper;
use Art\Model\FormMapper\RegisterFormMapper;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\Validations\FormValidations\LoginFormValidation;
use Art\Model\Validations\FormValidations\RegisterFormValidator;
use Art\View\Renderers\HomePageRenderer;
use Art\View\Renderers\LoginPageRenderer;
use Art\View\Renderers\OrdersPageRenderer;
use Art\View\Renderers\RegisterPageRenderer;
use Art\View\Renderers\UploadsPageRenderer;


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
     * @var HomePageRenderer
     */
    private  $homePageForm;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Request
     */
    private $request;


    public function __construct()
    {
        $this->homePageForm = HomePageRenderer::createRenderer();
        $this->loginForm = LoginPageRenderer::createRenderer();
        $this->registerForm= RegisterPageRenderer::createRenderer();

        $this->session = Session::createSession();
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

    /**
     * sets logged user on null and redirects to home page
     */
    public function logout()
    {
        $this->session->unsetSessionData(self::LOGGED_USER);

        header('Location:/');

    }

    /**
     * finds user in database and set him as logged
     */
    public function loginPost()
    {

        $mapper = new LoginFormMapper($this->request);
        $user = $mapper->getUserFromLoginForm();
        $databaseUser = PersistenceFactory::getFinderInstance('user')->findByEmail($user->getEmail());

        $loginValidator = new LoginFormValidation();

        if($errors = $loginValidator->validateData($databaseUser, $user)) {
            $this->goToLogin($errors);
            return;
        }
        $this->session->setSessionData(self::LOGGED_USER, $databaseUser->getId());

       header('Location:/');

    }

    /**
     * Saves user in the database , if inputs are valid and redirects to login page
     */
    public function registerPost()
    {
        $mapper = new RegisterFormMapper($this->request);
        $registeredUser = $mapper->getUserFromLoginForm();

        $validator = new RegisterFormValidator();
        $confirmationPass = $this->request->getPostSpecific(PASSWORD_CONFIRMATION);

        if($errors = $validator->validateIntroducedData($registeredUser, $confirmationPass)) {
            $registration = new RegisterPageRenderer();
            $registration->displayPage($errors);
            return;
        }

        PersistenceFactory::getMapperInstance('user')->insert($registeredUser);
        echo 'You have been registered successfully! Sign in to experience our world!'.PHP_EOL;
        $this->loginForm->displayPage();
    }

    /**
     * gets user's downloaded tiers from database and sends them to renderer
     */
    public function showOrders()
    {
        if(!$this->session->getSpecificSession(LOGGED_USER)) {
            $this->goToLogin(null);
            return;
        }

        $userOrderedProducts = PersistenceFactory::getFinderInstance(TIER_ENTITY)
            ->findByOrders($this->session
                ->getSpecificSession(self::LOGGED_USER));

        $renderer = new OrdersPageRenderer();
        $renderer->displayPage($userOrderedProducts);

    }

    /**
     * gets user's uploaded products from database and sends them to renderer
     */
    public function showUploads()
    {
        if(!$this->session->getSpecificSession(LOGGED_USER)) {
            $this->goToLogin(null);
            return;
        }
        $userUploadProducts = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)
            ->findUserProducts($this->session
                                    ->getSpecificSession(self::LOGGED_USER));

        $renderer = new UploadsPageRenderer();
        $renderer->displayPage($userUploadProducts);

    }

    /**
     * redirects page to login page
     */
    private function goToLogin($errors)
    {
        $renderer = new LoginPageRenderer();
        $renderer->displayPage($errors);
    }

}