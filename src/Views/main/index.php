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
                <img src="src/img/default.jpg" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $car['brand'].' '.$car['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
              <?php if(($key+1)%3==0):?>
              </div>
            </div>
            <?php endif ;?>
          <?php endforeach ;?>
          <div>
            <a href="">
              <button class="justify-content-end"> view all </button>
            </a>
          </div>
  </body>
</html>
