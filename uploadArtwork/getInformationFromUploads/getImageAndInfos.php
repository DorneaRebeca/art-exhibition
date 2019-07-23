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


function removeExtensionFromName($fileName)
{

    $imgName = preg_replace(IMAGE_NAME_PATTERN, '$1', $fileName);
    return $imgName;

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
            $path .= '/'.removeExtensionFromName($fileName).'.json';
        }
        return $path;
    }



    function createImagePath($imageName, $artistName) : string
    {
        $encodedArtistName = md5($artistName);
        $path = './uploads/'.$encodedArtistName;

        if(file_exists($path))
        {
            $path .= '/'.$imageName;
        }
        return $path;
    }



/**
 * @param $postData array containing information from post data
 * @return array
 */
function removeSlashesFromInfo($postData) : array
{
    $slashedData = [];
    $slashedData[IMG_NAME] = stripslashes($postData[IMG_NAME]);
    $slashedData[IMG_DESCRIPTION] = stripslashes($postData[IMG_DESCRIPTION]);
    $slashedData[ARTIST_NAME] = stripslashes($postData[ARTIST_NAME]);
    $slashedData[EMAIL] = stripslashes($postData[EMAIL]);
    $slashedData[CAMERA_SPECS] = stripslashes($postData[CAMERA_SPECS]);
    $slashedData[IMG_PRICE] = stripslashes($postData[IMG_PRICE]);
    $slashedData[CAPTURE_DATE] = stripslashes($postData[CAPTURE_DATE]);

    foreach ($postData[PHOTOGRAPHY_TYPE] as $tag)
    {
        $slashedData[PHOTOGRAPHY_TYPE][] =stripslashes($tag);
    }

    return $slashedData;
}

/**
 * Retrieves json data from a created path end returns it without slashes
 * @param $sessionGivenData
 * @return array
 */

    function retrieveJsonData($sessionGivenData) : array
    {
        $pathToFile = createJsonPath($sessionGivenData[FILE_NAME], $sessionGivenData[ARTIST_NAME]);

        $jsonData =  getJsonDataFromFile($pathToFile);

        $noSlashedData = removeSlashesFromInfo($jsonData);

        return $noSlashedData;
    }

