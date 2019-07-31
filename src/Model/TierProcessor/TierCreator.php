<?php

namespace Art\Model\TierProcessor;


use Art\Model\DomainObject\Tier;
use Art\Model\Persistence\PersistenceFactory;

class TierCreator
{
    private const WIDTH = 0;
    private const HEIGHT = 1;
    private const MEDIUM_SALE_AMOUNT = 0.2;
    private const SMALL_SALE_AMOUNT = 0.4;


    public function generateTiers($productID,  $initialPrice, $imageName)
    {
        $initialSize = $this->getInitialSize($imageName);

        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        //original -> large tier :
        $pathWithoutWatermark = uniqid().'.'.$imageExtension;
        $this->saveWithCLI($imageName, $imageName, $pathWithoutWatermark, $initialSize);

        $this->createTier($productID, SIZE_ENUM[LARGE], $initialPrice, $imageName, $pathWithoutWatermark);

        //medium size tier :
        $mediumSize = $this->resizeImage($initialSize);
        $this->generateModifiedTier($productID, $initialPrice, self::MEDIUM_SALE_AMOUNT, $imageName, $mediumSize, MEDIUM);

        //small size tier :
        $smallSize = $this->resizeImage($mediumSize);
        $this->generateModifiedTier($productID, $initialPrice, self::SMALL_SALE_AMOUNT, $imageName, $smallSize, SMALL);

        var_dump($initialSize);
        var_dump($mediumSize);
        var_dump($smallSize);
    }

    /**
     * Generates medium and small tiers -> the ones that need image modifications
     * @param $productID
     * @param $initialPrice
     * @param $saleAmount
     * @param $imageName
     * @param $size
     * @param $enumSize
     */
    private function generateModifiedTier($productID, $initialPrice, $saleAmount, $imageName, $size, $enumSize)
    {
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $pathWithWatermark = uniqid().'.'.$imageExtension;
        $pathWithoutWatermark = uniqid().'.'.$imageExtension;

        $price = $initialPrice - $saleAmount*$initialPrice;

        $this->saveWithCLI($imageName, $pathWithWatermark, $pathWithoutWatermark, $size);

        $this->createTier($productID, SIZE_ENUM[$enumSize], $price, $pathWithWatermark, $pathWithoutWatermark);
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
     * @param $watermarkName
     * @param $noWatermarkName
     * @param $imageSize
     */
    private function saveWithCLI($imageName, $watermarkName, $noWatermarkName, $imageSize)
    {
        $inputImagePath = IMG_PATH.$imageName;
        $pathWithWatermark = IMG_PATH.$watermarkName;
        $pathWithoutWatermark = IMG_PATH.$noWatermarkName;

        //TODO : CLI saveeer

    }

    /**
     * Retrieves the initial size from original saved image
     * @param $imageName
     * @return string
     * @throws \ImagickException
     */
    private function getInitialSize($imageName)
    {
        $image = new \Imagick(IMG_PATH.$imageName);
        $width = $image->getImageWidth();
        $height = $image->getImageHeight();

        return $width.":".$height;
    }





}