<?php

namespace Art\View\Renderers;

use Art\Model\DomainObject\Product;
use Art\Model\Http\Session;

class HomePageRenderer implements RendererInterface
{
    private $isLogged = false;
    /**
     * @var Session
     */
    private $session;

    private const IMAGE_PATH = '../../../src/assets/savedData/';


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