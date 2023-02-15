<h1 class="container text-center p-3 mb-2 bg-light"> <?= $car['brand'].' '.$car['model'] ?> </h1>
<div class="container text-center p-3 mb-2 bg-light">
  <div class="row justify-content-center p-3 mb-2">
    <div class="col-4">
      <img src="/src/img/cars/<?=$car['car_id']?>/<?=$car['default_image'] ?>" class="card-img-top" alt="...">
    </div>
    <div class="col-4">
      <h5 class="text-start">Date of production: <?= $car['date_production'] ?></h5> 
      <h5 class="text-start">Mileage: <?= $car['mileage'] ?></h5> 
      <h5 class="text-start">Price: <?= $car['price'] ?></h5> 
      <h5 class="text-start">Fuel: <?= $car['fuel'] ?></h5> 
      <h5 class="text-start">Hp: <?= $car['hp'] ?></h5> 
      <h5 class="text-start">Cubic: <?= $car['cubic'] ?></h5> 
      <h5 class="text-start">Transmission: <?= $car['transmission'] ?></h5> 
    </div>
    <div class="col-4"> 
      <h5 class="text-start">Published by: <?= ucwords($user['name']).' '.ucwords($user['last_name']) ?></h5> 
      <h5 class="text-start">Published: <?= $car['created_at'] ?></h5> 
    </div>
  </div>
  <div>
    <?php if(!empty($_SESSION)) : ?>
      <?php if($car['user_id'] == $_SESSION['id']) :?>
        <div class="row justify-content-center col-md-3 p-3 mb-2">
          <div class="col">
            <a href="/<?= $data['controller'] ?>/deleteCar/<?= $car['car_id']?>" class="btn btn-primary">Delete</a>
          </div>
          <div class="col">
            <a href="/main/edit/<?= $car['car_id']?>" class="btn btn-primary">Edit</a>
          </div>  
        </div>  
      <?php endif ;?>  
    <?php endif ;?>  
  </div>
</div>
 
