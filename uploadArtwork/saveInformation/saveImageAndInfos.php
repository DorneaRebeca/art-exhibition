<?php

    const IMAGE_NAME_PATTERN = '/(\w+)\.[jpeg|jpg|png]+$/';
    function createJSONFormat($postInformation, $path, $name)
    {
        $json_data = json_encode($postInformation);
        file_put_contents($path.'/'.$name.'.json', $json_data);

    }

    function removeExtensionFromName($fileName)
    {

        $imgName = preg_replace(IMAGE_NAME_PATTERN, '$1', $fileName);
        return $imgName;

    }

    /**
     * Saves the json file and the image in artist's personal directory
     * @param $inputInformation
     * @param $importedImage
     */
    function saveInputInformation($inputInformation, $importedImage)
    {
        $folderName = md5($inputInformation[ARTIST_NAME]);

        $path = DEFAULT_PATH. DIRECTORY_SEPARATOR .$folderName;

        /**
         * if the artist doesn't already have a personal directory, it will be created
         */
        if(!file_exists($path))
        {
            mkdir($path);
        }

        move_uploaded_file($importedImage[FILE_MIME_TYPE], $path. DIRECTORY_SEPARATOR .$importedImage[FILE_NAME]);

        createJSONFormat($inputInformation, $path, removeExtensionFromName($importedImage[FILE_NAME]) );
    }
