<?php


namespace Art\Model\TierProcessor;


class ThumbnailCreator
{

    public function saveThumbnail($imageName, $thumbnailName)
    {
        $imagePath = '/var/www/art-exhibition/'.IMG_PATH.$imageName;

        $thumbnailPath = '/var/www/art-exhibition/'.IMG_PATH.$thumbnailName;

        $width = $this->getNeededWidth($imageName);
        $height = $this->getNeededHeight($imageName);

        $commandWithoutWatermark = 'php /var/www/art-exhibition/image-modifier/src/my_command_line_tool.php  --input-file='.$imagePath.
            ' --output-file='.$thumbnailPath.' --width='.$width.' --height='.$height;
        $this->runCommand($commandWithoutWatermark);
    }

    /**
     * Retrieves initial width from original saved image and makes it 5 times smaller
     * @param $imageName
     * @return string
     * @throws \ImagickException
     */
    private function getNeededWidth($imageName)
    {
        $image = new \Imagick(IMG_PATH.$imageName);
        $width = $image->getImageWidth() / 5;

        return $width;
    }

    /**
     * Retrieves initial height from original saved image and makes it 5 times smaller
     * @param $imageName
     * @return string
     * @throws \ImagickException
     */
    private function getNeededHeight($imageName)
    {
        $image = new \Imagick(IMG_PATH.$imageName);
        $height = $image->getImageHeight() / 5;

        return $height;
    }

    private function runCommand($command)
    {
        system($command);
    }



}