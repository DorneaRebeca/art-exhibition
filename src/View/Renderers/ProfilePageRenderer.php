<?php

namespace Art\View\Renderers;

use Art\Model\DomainObject\Product;
use Art\Model\Http\Request;

class ProfilePageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public static function createRenderer()
    {
        return new self();
    }


    public function displayPage($userProducts)
    {
        $userUploads = $this->createDisplayData($userProducts);
        require 'src/View/Templates/uploadsAndDownloadsForm.php';
        require 'src/View/Templates/profilePageForm.php';
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