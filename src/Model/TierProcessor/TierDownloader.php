<?php


namespace Art\Model\TierProcessor;

class TierDownloader
{
    /**
     * Creates tier path based on image name and sends iti to be downloaded
     * @param $imageName
     */
    public function downloadTier($imageName)
    {
        $imagePath = FULL_IMG_PATH.$imageName;

        if (file_exists($imagePath)) {
            ob_clean();
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($imagePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($imagePath));
            flush();

            readfile($imagePath);

        }
    }

}