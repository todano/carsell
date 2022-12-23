<!doctype html>
<html>
  <?php require_once('header.php');?>
  <body>
    <h1 class="container text-center p-3 mb-2 bg-light"> <?= $car['brand'].' '.$car['model'] ?> </h1>

      <div class="container text-center p-3 mb-2 bg-light">
        <div class="row justify-content-center p-3 mb-2">
        <div class="col-4">
            <img src="/src/img/<?=$car['car_id']?>.jpg" class="card-img-top" alt="...">
          </div>
          <div class="col-4">
            <h5 class="text-start">Date of production: <?= $car['date_production'] ?></h5> 
            <h5 class="text-start">Mileage: <?= $car['mileage'] ?></h5> 
            <h5 class="text-start">Price: <?= $car['price'] ?></h5> 
          </div>
          <div class="col-4"> 
            <h5 class="text-start">Published by: <?= ucwords($user['name']).' '.ucwords($user['last_name']) ?></h5> 
            <h5 class="text-start">Published: <?= $car['created_at'] ?></h5> 
          </div>
        </div>
      </div>
  </body>
</html>
