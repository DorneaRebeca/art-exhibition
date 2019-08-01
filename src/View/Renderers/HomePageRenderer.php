<?php

namespace Art\View\Renderers;

use Art\Model\DomainObject\Product;
use Art\Model\Http\Session;

class HomePageRenderer
{
    private $isLogged = false;
    /**
     * @var Session
     */
    private $session;

    private $pageForm;

    private const IMAGE_PATH = '../../../src/assets/savedData/';


    public function __construct()
    {
        $this->session = Session::createSession();
    }

    public static function createRenderer()
    {
        return new self();
    }

    public function getHeader()
    {
        if($this->session->getSpecificSession(LOGGED_USER) )
        {
            return require 'src/View/Templates/loggedUserHeader.php';
        }
        return require 'src/View/Templates/defaultHeader.php';
    }

    public function displayPage(array $displayProducts)
    {
        $this->getHeader();
        $displayData = $this->createDisplayData($displayProducts);
        $commands = explode('/', $_SERVER['REQUEST_URI']);

        $pageNumber = (int)$commands[ sizeof($commands) - 1 ] + 1;
        $previousNumber = ($pageNumber-2);
        if($previousNumber <= 0)
            $previousNumber = 1;

         require 'src/View/Templates/homePageForm.php';
    }

    /**
     * @param $displayProducts Product[]
     * @return array
     */
    public function createDisplayData($displayProducts) : array
    {
        $displayData = [];
        foreach ($displayProducts as $product)
        {
          $data[IMG_NAME] = $product->getTitle();
          $data[IMG_DESCRIPTION] = $product->getDescription();
          $data[PHOTOGRAPHY_TYPE] = $product->getTags();
          $data[CAPTURE_DATE] = $product->getCaptureDate();
          $data[CAMERA_SPECS] = $product->getCameraSpecs();
          $data[IMG_SOURCE] = self::IMAGE_PATH.$product->getThumbnailPath();
          $data[ID_PRODUCT] = $product->getId();
          $displayData[] = $data;

        }
        return $displayData;

    }



}