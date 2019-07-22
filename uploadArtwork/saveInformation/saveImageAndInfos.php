<?php

    function createJSONFormat($postInformation, $path, $name)
    {
        $json_data = json_encode($postInformation);
        file_put_contents($path.'/'.$name.'.json', $json_data);

    }

    function saveInputInformation($inputInformation, $imageImported)
    {
        $folderName = md5($inputInformation[ARTIST_NAME]);

        $path = DEFAULT_PATH.'/'.$folderName;

        /**
         * if the artist doesn't already have a personal directory, it will be created
         */

        if(!file_exists($path))
        {
            mkdir($path, 0777);
        }

        move_uploaded_file($imageImported[FILE_MIME_TYPE], $path.'/'.$imageImported[FILE_NAME]);
        createJSONFormat($inputInformation, $path, $imageImported[FILE_NAME]);
    }
