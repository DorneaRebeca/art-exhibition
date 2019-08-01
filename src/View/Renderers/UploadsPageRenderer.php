<?php


namespace Art\View\Renderers;


use Art\Model\DomainObject\Product;
use Art\Model\Http\Session;

class UploadsPageRenderer
{
    private const IMAGE_PATH = '../../../src/assets/savedData/';

    public function getHeader()
    {
        if(Session::createSession()->getSpecificSession(LOGGED_USER) )
        {
            return require 'src/View/Templates/loggedUserHeader.php';
        }
        return require 'src/View/Templates/defaultHeader.php';
    }

    public function displayPage($uploads, $errorData=null)
    {
        $this->getHeader();
        $userUploads = $this->createUploadData($uploads);
        $errors = $errorData;
        require 'src/View/Templates/uploadsForm.php';
    }

    /**
     * @param $displayProducts Product[]
     * @return array
     */
    public function createUploadData($displayProducts) : array
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
            $displayData[] = $data;

        }
        return $displayData;
    }





}