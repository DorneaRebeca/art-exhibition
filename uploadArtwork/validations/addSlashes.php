<?php


/**
 * @param $postData array containing information from post data
 * @return array
 */
    function addSlashesToInput($postData) : array
    {
        $slashedData = [];
         $slashedData[IMG_NAME] = addslashes($postData[IMG_NAME]);
         $slashedData[IMG_DESCRIPTION] = addslashes($postData[IMG_DESCRIPTION]);
         $slashedData[ARTIST_NAME] = addslashes($postData[ARTIST_NAME]);
         $slashedData[EMAIL] = addslashes($postData[EMAIL]);
         $slashedData[CAMERA_SPECS] = addslashes($postData[CAMERA_SPECS]);
         $slashedData[IMG_PRICE] = addslashes($postData[IMG_PRICE]);
         $slashedData[CAPTURE_DATE] = addslashes($postData[CAPTURE_DATE]);

         foreach ($postData[PHOTOGRAPHY_TYPE] as $tag)
        {
            $slashedData[PHOTOGRAPHY_TYPE][] = addslashes($tag);
        }

         return $slashedData;
    }

