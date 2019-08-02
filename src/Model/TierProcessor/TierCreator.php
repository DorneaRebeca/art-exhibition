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

    private const WATERMARK_PATH = '/var/www/art-exhibition/src/assets/watermark.png';


    /**
     * Generates 3 tiers and saves them on database and on disk at a default path
     * @param $productID
     * @param $initialPrice
     * @param $imageName
     * @throws \ImagickException
     */
    public function generateTiers($productID,  $initialPrice, $imageName)
    {
        $initialSize = $this->getInitialSize($imageName);

        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        //original -> large tier :
        $pathWithoutWatermark = uniqid().'.'.$imageExtension;
        $height = $this->getImageHeight($initialSize, 0);
        $width = $this->getImageWidth($initialSize, 0);
        $this->saveWithCLI($imageName, $imageName, $pathWithoutWatermark, $width, $height);

        $this->createTier($productID, SIZE_ENUM[LARGE], $initialPrice, $imageName, $pathWithoutWatermark);

        //medium size tier :
        $this->generateModifiedTier($productID, $initialPrice, self::MEDIUM_SALE_AMOUNT, $imageName, $initialSize, MEDIUM, 20);

        //small size tier :
        $this->generateModifiedTier($productID, $initialPrice, self::SMALL_SALE_AMOUNT, $imageName, $initialSize, SMALL, 40);
    }

    /**
     * Generates medium and small tiers -> the ones that need image modifications
     * @param $productID
     * @param $initialPrice
     * @param $saleAmount
     * @param $imageName
     * @param $size
     * @param $enumSize
     * @param $scaleAmount
     */
    private function generateModifiedTier($productID, $initialPrice, $saleAmount, $imageName, $size, $enumSize, $scaleAmount)
    {
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $pathWithWatermark = uniqid().'.'.$imageExtension;
        $pathWithoutWatermark = uniqid().'.'.$imageExtension;

        $price = $initialPrice - $saleAmount*$initialPrice;

        $height = $this->getImageHeight($size, $scaleAmount);
        $width = $this->getImageWidth($size, $scaleAmount);

        $this->saveWithCLI($imageName, $pathWithWatermark, $pathWithoutWatermark, $width, $height);

        $this->createTier($productID, SIZE_ENUM[$enumSize], $price, $pathWithWatermark, $pathWithoutWatermark);
    }

    /**
     * Creates domain object of tier and saves it into database
     * @param $productId
     * @param $size
     * @param $price
     * @param $pathWithWatermark
     * @param $pathWithoutWatermark
     */
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
     * Gets image height at needed dimensions
     * @param $imgSize
     * @param $scaleAmount
     * @return int
     */
    private function getImageHeight($imgSize, $scaleAmount)
    {
         $sizeParams = explode(":", $imgSize);
        $height = (int)$sizeParams[self::HEIGHT] - $scaleAmount;

        return $height;
    }

    /**
     * Gets image width at needed dimensions
     * @param $imgSize
     * @param $scaleAmount
     * @return int
     */
    private function getImageWidth($imgSize, $scaleAmount)
    {
        $sizeParams = explode(":", $imgSize);
        $width = (int)$sizeParams[self::WIDTH] - $scaleAmount;

        return $width;
    }

    /**
     * Creates necessary commands and calls 'image-modifier' app to save the image
     * @param $imageName
     * @param $watermarkName
     * @param $noWatermarkName
     * @param $width
     * @param $height
     */
    public function saveWithCLI($imageName, $watermarkName, $noWatermarkName, $width, $height)
    {
        $inputImagePath = '/var/www/art-exhibition/'.IMG_PATH.$imageName;
        $pathWithWatermark = '/var/www/art-exhibition/'.IMG_PATH.$watermarkName;
        $pathWithoutWatermark = '/var/www/art-exhibition/'.IMG_PATH.$noWatermarkName;

        //construct command :

        $commandWithoutWatermark = 'php /var/www/art-exhibition/image-modifier/src/my_command_line_tool.php  --input-file='.$inputImagePath.
                                    ' --output-file='.$pathWithoutWatermark.' --width='.$width.' --height='.$height;
        $this->runCommand($commandWithoutWatermark);

        $commandWithWatermark = 'php /var/www/art-exhibition/image-modifier/src/my_command_line_tool.php  --input-file='.$inputImagePath.
                                ' --output-file='.$pathWithWatermark.' --width='.$width.' --height='.$height.' --watermark='.self::WATERMARK_PATH;
        $this->runCommand($commandWithWatermark);
    }

    /**
     * Runs image-modifier application with a given command
     * @param $command
     */
    private function runCommand($command)
    {
         system($command);
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