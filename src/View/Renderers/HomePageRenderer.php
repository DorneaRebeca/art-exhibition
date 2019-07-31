<?php

namespace Art\View\Renderers;

require_once 'src/uploadArtwork/constants.php';

use Art\Model\DomainObject\Product;
use Art\Model\Http\Session;

class HomePageRenderer
{
    private $isLogged = false;
    /**
     * @var Session
     */
    private $session;

    public function __construct()
    {
        $this->session = Session::createSession();
    }

    public static function createRenderer()
    {
        return new self();
    }

    public function displayPage(array $displayProducts)
    {
        if($this->session->getSpecificSession('isLogged') )
        {
            $this->isLogged = true;
        }

        $displayData = $this->createDisplayData($displayProducts);
        require 'src/View/Templates/HomePageForm.php';

    }

    /**
     * @param $displayProducts Product[]
     * @return array
     */
    public function createDisplayData($displayProducts) : array
    {
        //TODO : get image price from tier
        //TODO : get artistName from User
        $displayData = [];
        foreach ($displayProducts as $product)
        {
          $data[IMG_NAME] = $product->getTitle();
          $data[IMG_DESCRIPTION] = $product->getDescription();
          $data[PHOTOGRAPHY_TYPE] = $product->getTags();
          $data[CAPTURE_DATE] = $product->getCaptureDate();
          $data[CAMERA_SPECS] = $product->getCameraSpecs();
          $data[IMG_SOURCE] = $product->getThumbnailPath();
          $displayData[] = $data;

        }
        return $displayData;

    }



}