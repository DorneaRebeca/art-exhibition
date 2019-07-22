<?php

const EXTENSION_PATTERN = '/\w+\.[jpeg|jpg|png]+$/';

/**
 * @param $postData array containing all information existent after upload command
 * @return array containing all errors found
 */
    function validateMandatoryFields($postData, $imageData) : array
    {
        $errorList = [];
        if( empty($postData[IMG_NAME]) )
        {
            $errorList[] = 'Please introduce a title for the image';
        }

        if( empty($postData[ARTIST_NAME]) )
        {
            $errorList[] = 'Please introduce the artist\'s name';
        }

        if( empty($postData[EMAIL]) )
        {
            $errorList[] = 'Please introduce an email';
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
    function validatePrice($priceString) : array
    {
        $errorList =[];
        if(! preg_match(FLOAT_PATTERN, $priceString))
        {
            $errorList[] = 'The price you introduced is incorrect';
        }

        return $errorList;
    }


    function validateEmailAdress($email)
    {
        $error = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Incorrect email address';
        }

        return $error;
    }

    function validateImageExtension($imageName)  :array
    {
        $errorList = [];
        if(!preg_match(EXTENSION_PATTERN, $imageName))
        {
            $errorList[] = 'This extension is not supported by our application. Change it!';
        }
        return $errorList;

    }




    function validateAll($postData, $fileData) : array
    {
        $errorList = validateMandatoryFields($postData, $fileData[FILE_MIME_TYPE]);
        array_merge($errorList, validateEmailAdress($postData[EMAIL]));
        array_merge($errorList, validatePrice($postData[IMG_PRICE]));
        array_merge($errorList, validateImageExtension($fileData[FILE_MIME_TYPE]));
        return $errorList;
    }

