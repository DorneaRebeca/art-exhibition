<?php


namespace Art\Model\Validations\FormValidations;


class UploadProductFormValidator
{
    private const EXTENSION_PATTERN = '/\w+\.[jpeg|jpg|png]+$/';



    private function validateMandatoryFields( array $postData, $imageData) : array
    {
        $errorList = [];
        if( empty($postData[IMG_NAME]) )
        {
            $errorList[] = 'Please introduce a title for the image';
        }

        if( empty($postData[CAMERA_SPECS]) )
        {
            $errorList[] = 'Please introduce the camera specifications';
        }

        if( empty($postData[IMG_PRICE]) )
        {
            $errorList[] = 'Please introduce a price for this image';
        }

        if( empty($postData[CAPTURE_DATE]) )
        {
            $errorList[] = 'Please introduce the date when you captured the image';
        }

        if( empty($postData[IMG_DESCRIPTION]) )
        {
            $errorList[] = 'Please write an image description';
        }

        if(!isset($postData[PHOTOGRAPHY_TYPE]))
        {

            $errorList[] = 'Please choose at least one photography type';
        }

        if( empty($imageData) )
        {
            $errorList[] = 'You must introduce an image';
        }

        return $errorList;

    }

    /**
     *
     * @param $priceString string containing information introduced in the price field
     * @return array
     */
    private function validatePrice($priceString) : array
    {
        $errorList =[];
        if(! preg_match(FLOAT_PATTERN, $priceString))
        {
            $errorList[] = 'The price you introduced is incorrect';
        }

        return $errorList;
    }

    private function validateImageExtension($imageName)  :array
    {
        $errorList = [];
        if(!preg_match(self::EXTENSION_PATTERN, $imageName))
        {
            $errorList[] = 'This extension is not supported by our application. Change it!';
        }
        return $errorList;

    }

    public function validateAll($postData, $fileData) : array
    {
        var_dump($postData);
        $errorList = $this->validateMandatoryFields($postData, $fileData[IMG_SOURCE][FILE_MIME_TYPE]);
        array_merge($errorList, $this->validatePrice($postData[IMG_PRICE]));
        array_merge($errorList, $this->validateImageExtension($fileData[IMG_SOURCE][FILE_MIME_TYPE]));
        return $errorList;
    }

}