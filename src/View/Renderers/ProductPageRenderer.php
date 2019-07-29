<?php


namespace Art\View\Renderers;
require_once 'src/uploadArtwork/constants.php';

use Art\View\Request;

class ProductPageRenderer
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function takeInputs()
    {
        $this->request->getPostSpecific();
    }

    public function displayPage($displayProduct)
    {
        $product = $this->createProductData($displayProduct);
        require 'src/View/Templates/productPageForm.php';
    }

    /**
     * Parse from Product object to a list compatible with the form containing image data
     * @param $product
     * @return array
     */
    private function createProductData($product) :array
    {
        //TODO : get image REAL source...not the thumbnail
        //TODO : get image price from tier
        //TODO : get artistName from User
        $data[IMG_NAME] = $product->getTitle();
        $data[IMG_DESCRIPTION] = $product->getDescription();
        $data[PHOTOGRAPHY_TYPE] = $product->getTags();
        $data[CAPTURE_DATE] = $product->getCaptureDate();
        $data[CAMERA_SPECS] = $product->getCameraSpecs();
        $data[IMG_SOURCE] = $product->getThumbnailPath();

        return $data;
    }

}