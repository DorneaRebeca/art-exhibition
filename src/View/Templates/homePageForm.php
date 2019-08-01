<!DOCTYPE html>
<head>
    <title>Art Exhibition</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<div >

    <?php foreach ($displayData as $product):?>

            <img  src = "<?php echo $product[IMG_SOURCE] ?>" alt="" >
        <div class="card" style="width: 50rem;" >
            <div class="card-body">
                <h5 class="card-title"> <?php
                    if($product){?>
                        <dd class="col-sm-9"><?php echo $product[IMG_NAME].PHP_EOL ?></dd>
                    <?php }?>
                </h5>

                <dl class="row">
                    <?php
                    if($product){?>
                        <dt class="col-sm-3 text-truncate"> <?php echo 'Image Description : ' ?> </dt>
                        <dd class="col-sm-9"><?php echo $product[IMG_DESCRIPTION].PHP_EOL ?></dd>
                    <?php }?>

                    <dt class="col-sm-3 text-truncate"> <?php echo 'Photography Type : ' ?> </dt>
                    <dd class="col-sm-9">
                        <?php
                        foreach ($product[PHOTOGRAPHY_TYPE] as $tag){?>
                            <span class="badge badge-primary"><?php echo $tag ?></span>
                        <?php } ?>
                    </dd>
                </dl>
                <a href= "<?php echo "/product/showProduct/".$product[ID_PRODUCT] ?>" class="btn btn-info" role="button">See product</a>
            </div>
        </div>
    <?php endforeach; ?>


</div>
<a href="<?php echo '/product/showProducts/'.$previousNumber ?>"> Previous</a>

<a href="<?php echo '/product/showProducts/'.$pageNumber ?>"> Next</a>
</body>

</html>
