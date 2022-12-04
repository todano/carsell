<?php //echo '<pre>'; print_r($cars);
$count = count($cars)?>
<!doctype html>
<html>
  <?php require_once('header.php');?>
  <body>
    <h2> Here you can choose between many models, which will fits best to you</h2>

    <?php require_once('tableCard.php');?>


        <div class="container text-center p-3 mb-2 bg-light">
          <div class="row justify-content-center p-3 mb-2">
            <div class="col-4">
              <div class="card" style="width: 18rem;">
                <img src="https://i.pravatar.cc/60" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $cars[0]['brand'].' '.$cars[0]['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card" style="width: 18rem;">
                <img src="https://i.pravatar.cc/60" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $cars[1]['brand'].' '.$cars[1]['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center p-3 mb-2">
            <div class="col-3">
              <div class="card" style="width: 18rem;">
                <img src="https://i.pravatar.cc/60" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $cars[0]['brand'].' '.$cars[0]['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card" style="width: 18rem;">
                <img src="https://i.pravatar.cc/60" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $cars[1]['brand'].' '.$cars[1]['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card" style="width: 18rem;">
                <img src="https://i.pravatar.cc/60" class="card-img-top" alt="...">
                <div class="card-body bg-info">
                  <h5 class="card-title"><?= $cars[0]['brand'].' '.$cars[0]['model'] ?></h5>
                  <p class="card-text"> card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <div >
            <a href="">
              <button class="justify-content-end"> view all </button>
            </a>
          </div>
        </div>
  </body>
</html>
