<!DOCTYPE html>
<html>
    <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'header.php') ?>
    <body>
        <form method="POST" enctype="multipart/form-data" action="#" class="row g-3 vstack gap-2 col-md-5 mx-auto bg-light border border-primary rounded p-2 mb-2 mt-4">
            <div class="col-md-4">
                <label class="form-lable">Car brand</label>
                <input input="text" name="brand"> 
            </div>
            <div class="col-md-4">
                <label class="form-lable">Car model</label>
                <input input="text" name="model"> 
            </div>
            <div class="col-md-4">
                <label class="form-lable">Mileage</label>
                <input input="text" name="mileage"> 
            </div>
            <div class="col-md-4">
                <label class="form-lable">Date of production</label>
                <input input="text" name="year"> 
            </div>
            <div class="col-md-4">
                <label class="form-lable">Price</label>
                <input input="text" name="price"> 
            </div>
            <div class="col-md-4">
                <input type="file" name="my_file[]" multiple><br>
                <input type='hidden' name='id' value='<?php echo $id ?>'>
                <input type='submit' value='Upload'>
            </div>
            <?php
                if (isset($_FILES['my_file'])) {
                    $myFile = $_FILES['my_file'];
                    $fileCount = count($myFile["name"]);

                    for ($i = 0; $i < $fileCount; $i++) {
                        ?>
                            <p>File #<?= $i+1 ?>:</p>
                            <p>
                                Name: <?= $myFile["name"][$i] ?><br>
                                Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
                                Type: <?= $myFile["type"][$i] ?><br>
                                Size: <?= $myFile["size"][$i] ?><br>
                                Error: <?= $myFile["error"][$i] ?><br>
                            </p>
                        <?php
                    }
                }
            ?>   
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>

        </form>
    </body>
</html>