<?php //echo '<pre>'; print_r($cars);
// foreach($cars as $key => $car){
//   echo '<pre>'; echo "Marka: ".$key." i model: "; echo($car['brand']) ;
//   // echo '<pre>'; print_r($car) ;
// }
// die;
$count = count($cars); ?>
<!doctype html>
<html>
  <?php require_once('header.php');?>
  <body>
    <h2> Here you can choose between many models, which will fits best to you</h2>

    <?php require_once('tableCard.php');?>
      <?php foreach ($cars as $key => $car) :?>
        <?php if(($key)%3==0):?>
          <div class="container text-center p-3 mb-2 bg-light">
            <div class="row justify-content-center p-3 mb-2">
            <?php endif ; ?>
            <div class="col-4">
              <div class="card" style="width: 18rem;">
                <img src="/src/img/<?=$car['car_id']?>.jpg" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $car['brand'].' '.$car['model'] ?></h5>
                  <p class="card-text"> <?= $car['date_production'] ?></p>
                  <a href="/main/show/<?= $car['car_id']?>" class="btn btn-primary">View details</a>
                </div>
              </div>
            </div>
            <?php if(($key+1)%3==0):?>
              </div>
            </div>
            <?php endif ;?>
          <?php endforeach ;?>
          <div>
            <a href="/main/index/?page=1">
              <button class="justify-content-end"> 1 </button>
            </a>
            <a href="/main/index/?page=2">
              <button class="justify-content-end"> 2 </button>
            </a>
            <a href="/main/index/?page=3">
              <button class="justify-content-end"> 3 </button>
            </a>
          </div>
          <!-- TODO: link for all adverts and add a pagination -->
          <!-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav> -->
  </body>
</html>
