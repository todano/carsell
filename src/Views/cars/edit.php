<?php //echo '<pre>'; print_r($data); die; ?>
<form method="POST" action="/main/update/<?= $car['car_id'] ?>" enctype="multipart/form-data" class="row g-3 vstack gap-2 col-md-6 mx-auto bg-light border border-primary rounded p-2 mb-2 mt-4">
<div class="row">  
    <div class="col-md-4">
        <label class="form-lable">Car brand</label>
        <input input="text" name="brand" value="<?=$car['brand']?>"> 
    </div>
    <div class="col-md-4">
        <label class="form-lable">Car model</label>
        <input input="text" name="model" value="<?=$car['model']?>"> 
    </div>
    <div class="col-md-4">
        <label class="form-lable">Mileage</label>
        <input input="text" name="mileage" value="<?=$car['mileage']?>"> 
    </div>
</div>
<div class="row">  
    <div class="col-md-4">
        <label class="form-lable">Date of production</label>
        <input input="text" name="year" value="<?=$car['date_production']?>"> 
    </div>
    <div class="col-md-4">
        <label for="price" class="form-lable">Price</label>
        <input id="price" input="text" name="price" value="<?=$car['price']?>"> 
    </div>
    <div class="col-md-2 p-4">
        <select name="fuel" onchange="ddlselect();">
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
            <option value="Hybrid">Hybrid</option>
        </select>
    </div>
    <div class="col-md-2 p-4">
        <select name="category" onchange="ddlselect();">
            <option value="Sedan">Sedan</option>
            <option value="Hatchback">Hatchback</option>
            <option value="Wagon">Wagon</option>
            <option value="SUV">SUV</option>
            <option value="Jeep">Jeep</option>
        </select>
    </div>
</div>
<div class="row">  
    <div class="col-md-4">
        <label for="hp" class="form-lable">Hp</label>
        <input id="hp" input="text" name="hp" value="<?=$car['hp']?>"> 
    </div>
    <div class="col-md-4">
        <label for="cubic" class="form-lable">Cubic</label>
        <input id="cubic" input="text" name="cubic" value="<?=$car['cubic']?>"> 
    </div>
    <div class="col-md-4 p-4">
        <select name="transmission" onchange="ddlselect();">
            <option value="Automatic">Automatic</option>
            <option value="Manual">Manual</option>
        </select>
    </div>
    </div>
<div class="row">  
    <div class="col-md-4">
        <button class="btn btn-primary" type="submit">Submit chabges</button>
    </div>
</div>  
</form>
