<?php

namespace Art\View\Renderers;

use Art\Model\DomainObject\Product;
use Art\Model\DomainObject\tier;
use Art\Model\Http\Request;

class tierPageRenderer
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


    public function displayPage($product, $displayTier)
    {
        $tier = $this->createtierData($product, $displayTier);
        require 'src/View/Templates/productPageForm.php';
    }

    /**
     * Parse from tier object to a list compatible with the form containing image data
     * @param $tier
     * @return array
     */
    private function createtierData(Product $product,Tier $tiers) :array
    {
        //TODO : get image REAL source...not the thumbnail
        //TODO : get image price from tier
        //TODO : get artistName from User
        $displayData = [];
        foreach ($tiers as $tier)
        {
            $data[IMG_NAME] = $product->getTitle();
            $data[IMG_DESCRIPTION] = $product->getDescription();
            $data[PHOTOGRAPHY_TYPE] = $product->getTags();
            $data[CAPTURE_DATE] = $product>getCaptureDate();
            $data[CAMERA_SPECS] = $product->getCameraSpecs();
            $data[IMG_SOURCE] = $tier->getPathWithWatermark();
            $data[IMG_PRICE] = $tier->getPrice();
            $data[IMG_SIZE] = $tier->getSize();
            $data[ID_PRODUCT] = $tier->getId();

            $displayData[] = $data;
        }
        return $displayData;
    }

}