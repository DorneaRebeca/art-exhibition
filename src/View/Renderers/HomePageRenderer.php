<?php

namespace Art\View\Renderers;

require_once 'src/uploadArtwork/constants.php';

use Art\Model\DomainObject\Product;
use Art\View\Request;

class HomePageRenderer
{

    public function __construct()
    {
    }

    public function displayPage(array $displayProducts)
    {
        var_dump($displayProducts);
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