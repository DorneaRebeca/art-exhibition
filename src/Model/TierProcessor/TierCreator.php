<?php

namespace Art\Model\TierProcessor;

require 'src/constants.php';

use Art\Model\DomainObject\Tier;
use Art\Model\Persistence\PersistenceFactory;

class TierCreator
{
    private const WIDTH = 0;
    private const HEIGHT = 1;

    /**
     * Retrieves image extension from image name
     * @param $imageName
     * @return mixed
     */
    private function getImageExtension($imageName)
    {
        $parts = explode('.', $imageName);
        return $parts[sizeof($parts) - 1];
    }


    private function createTier($productId, $size, $price, $pathWithWatermark, $pathWithoutWatermark )
    {
        $tier = new Tier($productId, $size, $price, $pathWithWatermark, $pathWithoutWatermark);
        PersistenceFactory::getMapperInstance(TIER_ENTITY)->insert($tier);
    }

    /**
     * Receives a Width : Height format image size and returns a resized image for the format command in image-modifier app
     * @param $imgSize
     * @return string
     */
    private function resizeImage($imgSize) : string
    {
        $sizeParams = explode(":", $imgSize);
        $width = (int)$sizeParams[self::WIDTH] - 20;
        $height = (int)$sizeParams[self::HEIGHT] - 20;

        return $width.':'.$height;
    }

    /**
     * Creates necessary commands and calls 'image-modifier' app to save the image
     * @param $imageName
     */
    private function saveWithCLI($imageName, $watermarkName, $noWatermarkName, $imageSize)
    {
        $inputImagePath = IMG_PATH.$imageName;
        $pathWithWatermark = IMG_PATH.$watermarkName;
        $pathWithoutWatermark = IMG_PATH.$noWatermarkName;

        //TODO : CLI saveeer
    }

    public function generateTiers($productID, $initialSize, $initialPrice, $imageName)
    {
        //original -> large tier :
        $pathWithoutWatermark = uniqid().$this->getImageExtension($imageName);

        $this->saveWithCLI($imageName, $imageName, $pathWithoutWatermark, $initialSize);

        $this->createTier($productID, SIZE_ENUM[LARGE], $initialPrice, $imageName, $pathWithoutWatermark);

        //medium size tier :
        $pathWithWatermarkMedium = uniqid().$this->getImageExtension($imageName);
        $pathWithoutWatermarkMedium = uniqid().$this->getImageExtension($imageName);
        $mediumSize = $this->resizeImage($initialSize);

        $this->saveWithCLI($imageName, $pathWithWatermarkMedium, $pathWithoutWatermarkMedium, $mediumSize);

        $mediumPrice = $initialPrice -  0.2*$initialPrice;
        $this->createTier($productID, SIZE_ENUM[MEDIUM], $mediumPrice, $pathWithWatermarkMedium, $pathWithoutWatermarkMedium);

        //small size tier :
        $pathWithWatermarkSmall = uniqid().$this->getImageExtension($imageName);
        $pathWithoutWatermarkSmall = uniqid().$this->getImageExtension($imageName);
        $smallSize = $this->resizeImage($mediumSize);

        $this->saveWithCLI($imageName, $pathWithWatermarkSmall, $pathWithoutWatermarkSmall, $smallSize);

        $mediumPrice = $initialPrice -  0.4*$initialPrice;
        $this->createTier($productID, SIZE_ENUM[SMALL], $mediumPrice, $pathWithWatermarkSmall, $pathWithoutWatermarkSmall);


    }

}