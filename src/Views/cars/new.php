<!DOCTYPE html>
<html>
    <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'header.php') ?>
    <body>
        <form method="POST" action="/cars/store/" enctype="multipart/form-data" class="row g-3 vstack gap-2 col-md-5 mx-auto bg-light border border-primary rounded p-2 mb-2 mt-4">
          <div class="row">  
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
          </div>
          <div class="row">  
            <div class="col-md-4">
                <label class="form-lable">Date of production</label>
                <input input="text" name="year"> 
            </div>
            <div class="col-md-4">
                <label for="price" class="form-lable">Price</label>
                <input id="price" input="text" name="price"> 
            </div>
            <div class="col-md-4">
                <label for="fuel" class="form-lable">Fuel</label>
                <input id="fuel" input="text" name="fuel"> 
            </div>
          </div>
          <div class="row">  
            <div class="col-md-4">
                <label for="hp" class="form-lable">Hp</label>
                <input id="hp" input="text" name="hp"> 
            </div>
            <div class="col-md-4">
                <label for="cubic" class="form-lable">Cubic</label>
                <input id="cubic" input="text" name="cubic"> 
            </div>
            <div class="col-md-4">
                <label for="category" class="form-lable">Category</label>
                <input id="category" input="text" name="category"> 
            </div>
          </div>
          <div class="row">  
            <div class="col-md-4">
                <label for="transmission" class="form-lable">Transmission</label>
                <input id="transmission" input="text" name="transmission"> 
            </div>
            <div class="col-md-4 position-relative">
                <div class="col-md-2 position-absolute top-0 start-0" style="font-size:12px;">
                    <label for="file"><img src="/src/img/default.jpg" class="rounded mx-auto d-block" width="80" height="100"></label>
                    <input id="file" type="file" name="my_file[]" multiple style="display: none">
                </div>
            </div>
          </div>  
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </body>
</html>