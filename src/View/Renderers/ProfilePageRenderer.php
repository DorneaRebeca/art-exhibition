<?php


namespace Art\View\Renderers;

use Art\View\Request;

class ProfilePageRenderer
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
        require 'src/View/Templates/profilePageForm.php';
    }

}