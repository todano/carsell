<!DOCTYPE html>
<html>
    <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'header.php') ?>
    <body>
        <form method="POST" action="/cars/store/" enctype="multipart/form-data" class="row g-3 vstack gap-2 col-md-5 mx-auto bg-light border border-primary rounded p-2 mb-2 mt-4">
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
                <input type='file' name='file'><br>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>

        </form>
    </body>
</html>