<!DOCTYPE html>

<html>
<head>
    <title>Art Exhibition</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">


</head>
<body>
<a href="/user/register"> Sign up </a>
<a href="/user/login"> Sign in </a>
<a href="/product/uploadProduct"> Upload Artwork </a>

<div class="wrapper">
    <dl class="row">
        <?php
        if($product){?>
            <dt id="left-label" class="col-sm-3 text-truncate"> <?php echo 'Image title : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[IMG_NAME].PHP_EOL ?></dd>
        <?php }?>

        <?php
        if($product){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Image Description : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[IMG_DESCRIPTION].PHP_EOL ?></dd>
        <?php }?>

<!--        --><?php
//        if($product){?>
<!--            <dt class="col-sm-3 text-truncate"> --><?php //echo 'Image price : ' ?><!-- </dt>-->
<!--            <dd class="col-sm-9">--><?php //echo $product[IMG_PRICE].PHP_EOL ?><!--</dd>-->
<!--        --><?php //}?>

        <?php
        if($product){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Camera specs : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[CAMERA_SPECS].PHP_EOL ?></dd>
        <?php }?>

        <?php
        if($product){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[CAPTURE_DATE].PHP_EOL ?></dd>
        <?php }?>

        <?php
        if($product){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Created by : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[ARTIST_NAME].PHP_EOL ?></dd>
        <?php } ?>

        <?php
        if($product){?>
            <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
            <dd class="col-sm-9"><?php echo $product[CAPTURE_DATE].PHP_EOL ?></dd>
        <?php }?>

        <dt class="col-sm-3 text-truncate"> <?php echo 'Photography Type : ' ?> </dt>
        <dd class="col-sm-9">
            <?php
            foreach ($product[PHOTOGRAPHY_TYPE] as $tag){?>
                <span class="badge badge-primary"><?php echo $tag ?></span>
            <?php } ?>
        </dd>
    </dl>

    <img src = "<?php echo $product[IMG_SOURCE] ?>" alt="real image">

    <a href="/product/buyProduct" class="btn btn-info" role="button">Buy Product</a>


</div>


</body>



</html>
