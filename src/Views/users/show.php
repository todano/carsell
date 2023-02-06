<h1 class="container text-center p-3 mb-2 bg-light"> <?= $data['name'].' '.$data['last_name'] ?> </h1>
<div class="container text-center p-3 mb-2 bg-light">
  <div class="row justify-content-center p-3 mb-2">
      <div class="col-4">
          <!-- <img src="/src/img/<?=$car['car_id']?>/<?=$car['default_image'] ?>" class="card-img-top" alt="..."> -->
      </div>
      <div class="col-4">
          <h5 class="text-start">Username: <?= $data['username'] ?></h5> 
          <h5 class="text-start">Email: <?= $data['email'] ?></h5> 
          <h5 class="text-start">City: <?= $data['city'] ?></h5> 
      </div>
      <div class="col-4"> 
          <h5 class="text-start">Last update: <?= $data['last_update'] ?></h5> 
      </div>
  </div>
</div>
