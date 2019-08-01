<?php

namespace Art\View\Renderers;

use Art\Model\DomainObject\Product;
use Art\Model\Http\Request;

class ProductPageRenderer
{
    private $request;
    private const IMAGE_PATH = '../../../src/assets/savedData/';

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

        $displayData = $this->createProductData($product, $displayTier);
        require 'src/View/Templates/productPageForm.php';
    }

    /**
     * Parse from tier object to a list compatible with the form containing image data
     * @param Product $product
     * @param array $tiers
     * @return array
     */
    private function createProductData(Product $product,array $tiers) :array
    {

        $displayData = [];
        foreach ($tiers as $tier)
        {
            $data[IMG_NAME] = $product->getTitle();
            $data[IMG_DESCRIPTION] = $product->getDescription();
            $data[PHOTOGRAPHY_TYPE] = $product->getTags();
            $data[CAPTURE_DATE] = $product->getCaptureDate();
            $data[CAMERA_SPECS] = $product->getCameraSpecs();
            $data[IMG_SOURCE] = self::IMAGE_PATH.$tier->getPathWithWatermark();
            $data[IMG_PRICE] = $tier->getPrice();
            $data[IMG_SIZE] = $tier->getSize();
            $data[ID_PRODUCT] = $tier->getId();

            $displayData[] = $data;
        }
        return $displayData;
    }

}