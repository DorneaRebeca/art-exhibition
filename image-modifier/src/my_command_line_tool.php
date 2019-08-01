<?php

    include "/var/www/art-exhibition/image-modifier/src/loadImage/readImage.php";
    include "/var/www/art-exhibition/image-modifier/src/input/cli.php";
    include "/var/www/art-exhibition/image-modifier/src/saveImage/saveFile.php";
    include "/var/www/art-exhibition/image-modifier/src/operations/heightOperation.php";
    include "/var/www/art-exhibition/image-modifier/src/operations/widthOperation.php";
    include "/var/www/art-exhibition/image-modifier/src/operations/ratioOperation.php";
    include "/var/www/art-exhibition/image-modifier/src/watermarkOp/watermarkOperation.php";
    include "/var/www/art-exhibition/image-modifier/src/errors/error.php";
    include "/var/www/art-exhibition/image-modifier/src/output/output.php";
    include "/var/www/art-exhibition/image-modifier/src/validations/validations.php";
    include "/var/www/art-exhibition/image-modifier/src/helpCommand/help.php";

const WIDTH_COMMAND = '--width';
const HEIGHT_COMMAND = '--height';
const FORMAT_COMMAND = '--format';
const IMAGE_KEY = 'image';
const OUTPUT_KEY = '--output-file';
const INPUT_KEY = '--input-file';
const WATERMARK = '--watermark';
const DEFAULT_PATH = '/var/www/art-exhibition/src/assets/';
const HELP_COMMAND = '--help';



    $payload = createArrayFromInput($argv);

    if(!executeHelp($payload))
    {
        $payload = validate($payload);
        $payload = readImage($payload);
        $payload = executeWidth($payload);
        $payload = executeHeight($payload);
        $payload = executeFormat($payload);
        $payload = executeWatermark($payload);
        $payload = saveImage($payload);
    }



