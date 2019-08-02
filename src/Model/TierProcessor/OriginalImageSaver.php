<?php

namespace Art\Model\TierProcessor;

class OriginalImageSaver
{

    /**
     * Receives FILE global variable and saves the file on disk on a default path
     * @param $filesData
     * @return string
     */
    public function saveOriginalImage($filesData)
    {
        $imageName = uniqid().'.'.pathinfo($filesData[IMG_SOURCE][FILE_NAME], PATHINFO_EXTENSION);

        move_uploaded_file($filesData[IMG_SOURCE][FILE_MIME_TYPE], IMG_PATH.$imageName);

        return $imageName;
    }

}