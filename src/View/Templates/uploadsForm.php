
<html>

<!DOCTYPE html>
<head>
    <title>Art Exhibition</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>


    <h4> My uploads</h4>
    <?php foreach ($userUploads as $product):?>

        <div class="card" style="width: 40rem;">
            <img class="card-img-top" src = "<?php echo $product[IMG_SOURCE] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"> <?php
                    if($product){?>
                        <dt id="left-label" class="col-sm-3 text-truncate"> <?php echo 'Image title : ' ?> </dt>
                        <dd class="col-sm-9"><?php echo $product[IMG_NAME].PHP_EOL ?></dd>
                    <?php }?>
                </h5>
                <dt class="col-sm-3 text-truncate"> <?php echo 'Photography Type : ' ?> </dt>
                <dd class="col-sm-9">
                    <?php
                    foreach ($product[PHOTOGRAPHY_TYPE] as $tag){?>
                        <span class="badge badge-primary"><?php echo $tag ?></span>
                    <?php } ?>
                </dd>
                </dl>
            </div>
        </div>
    <?php endforeach; ?>
    </div>


</html>
