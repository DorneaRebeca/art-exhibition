<?php


namespace Art\View\Renderers;


use Art\Model\Http\Request;

class ProfilePageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }


    public function displayPage()
    {
        require 'src/View/Templates/profilePageForm.php';
    }

}