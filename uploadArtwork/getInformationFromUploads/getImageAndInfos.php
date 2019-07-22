<?php
/**
 * Reads content from a JSON file and returns the decoded array
 * @param $path string containing the path
 * @return array
 */

    function getJsonDataFromFile($path) : array
    {
        $jsonData = file_get_contents($path);
        $decodedData = json_decode($jsonData, TRUE);

        return $decodedData;
    }

/**
 * Creates the path to read json file.
 * The directory name is an encoded string from artists name
 * @param $fileName
 * @param $artistName
 * @return string
 */
    function createJsonPath($fileName, $artistName)
    {
        $encodedArtistName = md5($artistName);
        $path = DEFAULT_PATH.'/'.$encodedArtistName;
        if(file_exists($path))
        {
            $path .= '/'.$fileName.'.json';
        }
        print $path.PHP_EOL;
        return $path;
    }

    function createImagePath($imageName, $artistName) : string
    {
        $encodedArtistName = md5($artistName);
        $path = DEFAULT_PATH.'/'.$encodedArtistName;
        if(file_exists($path))
        {
            $path .= '/'.$imageName;
        }
        print $path.PHP_EOL;
        return $path;
    }

    function retrieveJsonData($sessionGivenData) : array
    {
        $pathToFile = createJsonPath($sessionGivenData[FILE_NAME], $sessionGivenData[ARTIST_NAME]);
        return getJsonDataFromFile($pathToFile);
    }

