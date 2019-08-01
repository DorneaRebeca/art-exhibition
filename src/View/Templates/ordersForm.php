<html>

<!DOCTYPE html>

<body>
<head>
    <title>Art Exhibition</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-sm" name="UPLOADS">
                <div class="col-sm">
                    <h4> My orders</h4>
                    <?php foreach ($userOrders as $product):?>

                        <div class="card" style="width: 40rem;">
                            <img class="card-img-top" src = "<?php echo $product[IMG_SOURCE] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"> <?php
                                    if($product){?>
                                        <dt id="left-label" class="col-sm-3 text-truncate"> <?php echo 'Image price : ' ?> </dt>
                                        <dd class="col-sm-9"><?php echo $product[IMG_PRICE].PHP_EOL ?></dd>
                                    <?php }?>
                                </h5>

                                <dl class="row">
                                    <?php
                                    if($product){?>
                                        <dt class="col-sm-3 text-truncate"> <?php echo 'Image size : ' ?> </dt>
                                        <dd class="col-sm-9"><?php echo $product[IMG_SIZE].PHP_EOL ?></dd>
                                    <?php }?>
                                </dl>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>

            </div>
        </div>
</body>

</html>
