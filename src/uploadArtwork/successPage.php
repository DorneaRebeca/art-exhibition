<?php

    include "./getInformationFromUploads/getImageAndInfos.php";
    include "constants.php";

    session_start();
    ini_set('display_errors', 'ON');

    $jsonData = retrieveJsonData($_SESSION);

    /**
     * Used to display image on browser
     */
    $imagePath = createImagePath($_SESSION[FILE_NAME], $_SESSION[ARTIST_NAME]);

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

<div id="wrapper">

        <h2>Your image has been successfully updated :)</h2>
        <dl class="row">
            <?php
                if($jsonData){?>
            <dt id="left-label" class="col-sm-3 text-truncate"> <?php echo 'Image title : ' ?> </dt>
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
                <dt class="col-sm-3 text-truncate"> <?php echo 'Camera specs : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[CAMERA_SPECS].PHP_EOL ?></dd>
            <?php }?>

            <?php
            if($jsonData){?>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
                <dd class="col-sm-9"><?php echo $jsonData[CAPTURE_DATE].PHP_EOL ?></dd>
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

            <dt class="col-sm-3 text-truncate"> <?php echo 'Photography Type : ' ?> </dt>
            <dd class="col-sm-9">
            <?php
                foreach ($jsonData[PHOTOGRAPHY_TYPE] as $tag){?>
                <span class="badge badge-primary"><?php echo $tag ?></span>
                <?php } ?>
            </dd>
        </dl>


        <img src = "<?php echo $imagePath ?>" class="img-thumbnail" >

</div>

</body>


</html>

