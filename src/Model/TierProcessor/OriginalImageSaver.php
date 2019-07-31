<?php

namespace Art\Model\TierProcessor;

class OriginalImageSaver
{

    public function saveOriginalImage($filesData)
    {
        $imageName = uniqid().'.'.pathinfo($filesData[IMG_SOURCE][FILE_NAME], PATHINFO_EXTENSION);
        var_dump($imageName);

        move_uploaded_file($filesData[IMG_SOURCE][FILE_MIME_TYPE], IMG_PATH.$imageName);

        return $imageName;
    }

}