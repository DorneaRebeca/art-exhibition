<?php

namespace Art\Controller\Model\FormMapper;

require 'src/constants.php';

use Art\Model\DomainObject\Product;
use Art\Model\Http\Request;

class UploadImageFormMapper
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function getImageExtension($imageName)
    {
        $parts = explode('.', $imageName);
        return $parts[sizeof($parts) - 1];
    }

    public function getProductFromUploadForm($userID)
    {
        $title = $this->request->getPostSpecific(IMG_NAME);
        $description = $this->request->getPostSpecific(IMG_DESCRIPTION);
        $tags = $this->request->getPostSpecific(PHOTOGRAPHY_TYPE);
        $cameraSpecs = $this->request->getPostSpecific(CAMERA_SPECS);
        $captureDate = new \DateTime($this->request->getPostSpecific(CAPTURE_DATE));
        $thumbnailPath = uniqid().$this->getImageExtension( $this->request->getFileSpecific(FILE_MIME_TYPE));

        return new Product($title, $description, $tags, $cameraSpecs, $captureDate, $thumbnailPath, $userID);
    }

}