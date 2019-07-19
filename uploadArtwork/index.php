<?php
    include "constants.php";
    include "saveInformation/saveImageAndInfos.php";
    include "validations/inputValidations.php";



    ini_set('display_errors', 'ON');

    if($_POST && count($_FILES)){
        var_dump($_POST);

        $errors = validateAll($_POST, $_FILES);

        if(count($errors) == 0)
        {
            saveInputInformation($_POST, $_FILES[IMG_SOURCE]);
        }

        //TODO - add slashes for all strings
        //TODO - validate extensions

    }
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

        <div class="content">
            <h1>Add Image</h1>
            <!-- NOTE the enctype="multipart/form-data". That attribute allows the file upload. -->

            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imageName">Image name</label>
                <input name="imageName" type="text" class="form-control" id="imgName" placeholder="Image Name">
            </div>

                <div class="form-group">
                    <label for="imageDescription">Description</label>
                    <textarea class="form-control" rows="5" id="imageDescription" name="imageDescription"></textarea>
                </div>

                <div class="form-group">
                    <label for="artistEmail">Email address</label>
                    <input type="email" name="artistEmail" class="form-control" id="artistEmail" aria-describedby="email" placeholder="Enter email">
                    <small id="artistEmail"  class="form-text text-muted">We'll never share your email with anyone else :D.</small>
                </div>

                <div class="form-group">
                    <label for="artistName">Artist Name</label>
                    <input name="artistName" type="text" class="form-control" id="artistName" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="cameraSpecs">Camera Specifications </label>
                    <textarea class="form-control" rows="5" id="cameraSpecs" name="cameraSpecs"></textarea>
                </div>

                <div class="form-group">
                    <label for="imagePrice">Image Price</label>
                    <input name="imagePrice" type="number" class="form-control" id="imagePrice" placeholder="Price">
                </div>

                <div class="form-group">
                    <label for="captureDate">Capture date</label>
                    <input name="captureDate" type="date" class="form-control" id="captureDate" placeholder="yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="photographyType">Photography Type</label>
                    <select class="form-control form-control-lg" name="photographyType" id="photographyType" multiple>
                        <option>Drone Photography</option>
                        <option>Editorial Photography</option>
                        <option>Family Photography</option>
                        <option>Fashion Photography</option>
                        <option>Fine Art Photography</option>
                        <option>Golden Hour Photography</option>
                        <option>Indoor Photography</option>
                        <option>Infrared Photography</option>
                        <option>Landscape Photography</option>
                        <option>Long Exposure Photography</option>
                        <option>Macro Photography</option>
                        <option>Minimalist Photography</option>
                        <option>Night Photography</option>
                        <option>Portrait Photography</option>
                        <option>Seascape Photography</option>
                        <option>Urban Exploration Photography</option>
                        <option>Photojournalism</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="chooseImg">Browse image</label>
                    <input type="file" class="form-control-file" id="chooseImg" name="imageSource">
                </div>

                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo '*'.implode('<br>*', $errors) ?></div>
                <?php } ?>

                <button type="submit" class="btn btn-success">Upload image</button>

            </form>


        </div>





</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>






</html>








