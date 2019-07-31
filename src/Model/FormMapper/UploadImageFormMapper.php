<?php

namespace Art\Model\FormMapper;


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



    public function getProductFromUploadForm($userID)
    {
        $imgExtension = pathinfo($this->request->getFileSpecific(FILE_NAME), PATHINFO_EXTENSION);

        $title = $this->request->getPostSpecific(IMG_NAME);
        $description = $this->request->getPostSpecific(IMG_DESCRIPTION);
        $tags = $this->request->getPostSpecific(PHOTOGRAPHY_TYPE);
        $cameraSpecs = $this->request->getPostSpecific(CAMERA_SPECS);
        $captureDate = new \DateTime($this->request->getPostSpecific(CAPTURE_DATE));
        $thumbnailPath = uniqid().'.'.$imgExtension;

        return new Product($title, $description, $tags, $cameraSpecs, $captureDate, $thumbnailPath, $userID);
    }

}