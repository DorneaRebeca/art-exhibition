<?php

    include "./getInformationFromUploads/getImageAndInfos.php";
    include "constants.php";

    session_start();
    ini_set('display_errors', 'ON');


    $jsonData = retrieveJsonData($_SESSION);

   //TODO - see why the image doesn't appear in browser





?>


<!DOCTYPE html>

<html>
<head>
    <title>Upload Image</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">


</head>
<body>


        <h2>The image has been saved with success :)</h2>
        <dl class="row">
            <?php
                if($jsonData){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Image title : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $jsonData[IMG_NAME].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Image Description : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[IMG_DESCRIPTION].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Image price : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[IMG_PRICE].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Camera specifications : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[CAMERA_SPECS].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[CAPTURE_DATE].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Photography type : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[PHOTOGRAPHY_TYPE].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Created by : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[ARTIST_NAME].PHP_EOL ?></dd>
            <?php } ?>

            <?php
                if($jsonData){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $jsonData[CAPTURE_DATE].PHP_EOL ?></dd>
            <?php }?>
        </dl>
        <img src = "<?php createImagePath($_SESSION[FILE_NAME], $_SESSION[ARTIST_NAME]) ?>"  class="img-thumbnail" >

</body>


</html>

