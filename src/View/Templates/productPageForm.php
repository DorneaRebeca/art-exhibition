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
<a href="/product/showProducts"> HomePage</a>
<a href="/user/logout">Sign out</a>


<div class="wrapper">

    <div class="container">
        <div class="row">
            <?php foreach ($displayData as $tier): ?>
            <div class="col-sm">
                <dl class="row">
                    <?php
                        if($tier){?>
                            <dt id="left-label" class="col-sm-3 text-truncate"> <?php echo 'Image title : ' ?> </dt>
                            <dd class="col-sm-9"><?php echo $tier[IMG_NAME].PHP_EOL ?></dd>
                        <?php }?>

                        <?php
                        if($tier){?>
                            <dt class="col-sm-3 text-truncate"> <?php echo 'Image Description : ' ?> </dt>
                            <dd class="col-sm-9"><?php echo $tier[IMG_DESCRIPTION].PHP_EOL ?></dd>
                        <?php }?>

                        <?php
                        if($tier){?>
                            <dt class="col-sm-3 text-truncate"> <?php echo 'Image price : ' ?> </dt>
                            <dd class="col-sm-9"><?php echo $tier[IMG_PRICE].PHP_EOL ?></dd>
                        <?php }?>

                        <?php
                        if($tier){?>
                            <dt class="col-sm-3 text-truncate"> <?php echo 'Camera specs : ' ?> </dt>
                            <dd class="col-sm-9"><?php echo $tier[CAMERA_SPECS].PHP_EOL ?></dd>
                        <?php }?>

                        <?php
                        if($tier){?>
                            <dt class="col-sm-3 text-truncate"> <?php echo 'Capture date : ' ?> </dt>
                            <dd class="col-sm-9"><?php echo $tier[CAPTURE_DATE]->format('Y-m-d').PHP_EOL ?></dd>
                        <?php }?>



                        <dt class="col-sm-3 text-truncate"> <?php echo 'Photography Type : ' ?> </dt>
                        <dd class="col-sm-9">
                            <?php
                            foreach ($tier[PHOTOGRAPHY_TYPE] as $tag){?>
                                <span class="badge badge-primary"><?php echo $tag ?></span>
                            <?php } ?>
                        </dd>
                    </dl>
                <img src = "<?php echo $tier[IMG_SOURCE] ?>" alt="real image">
                <a href="<?php echo '/product/buyProduct/'.$tier[ID_PRODUCT]?>" class="btn btn-info" role="button">Buy tier</a>


                <?php endforeach; ?>

            </div>




</div>
    </div>

</div>
</body>

</html>
