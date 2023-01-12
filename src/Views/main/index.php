<?php //echo '<pre>'; print_r($data); die; ?>
<!doctype html>
<html>
  <?php require_once('header.php');?>
  <body>
    <h2 class="text-center"> Here you can choose between many models, which will fits best to you</h2>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <h5>Items per page: </h5>
        <?php if(isset($search)) :?>
          <li class="page-item"><a class="page-link" href="/search/index/?page=1&perPage=6&search=<?= $search ?>">6</a></li>
          <li class="page-item"><a class="page-link" href="/search/index/?page=1&perPage=9&search=<?= $search ?>">9</a></li>
        <?php else :?>
          <li class="page-item"><a class="page-link" href="/main/index/?page=1&perPage=6">6</a></li>
          <li class="page-item"><a class="page-link" href="/main/index/?page=1&perPage=9">9</a></li>
        <?php endif ; ?>
      </ul>
    </nav>
    <?php //require_once('tableCard.php');?>
    <?php foreach ($cars as $key => $car) :?>
      <?php if(($key)%3==0):?>
        <div class="container text-center p-3 mb-2 bg-light">
          <div class="row justify-content-center p-3 mb-2">
          <?php endif ; ?>
          <div class="col-4">
            <div class="card" style="width: 18rem;">
              <img src="/src/img/<?=$car['car_id']?>/<?=$car['default_image'] ?>" class="card-img-top" alt="...">
              <div class="card-body bg-info">
                <h5 class="card-title"><?= $car['brand'].' '.$car['model'] ?></h5>
                <h5 class="card-text"> <?= $car['date_production'] ?></h5>
                <h5 class="card-text"> <?= $car['price'] ?></h5>
                <a href="/main/show/<?= $car['car_id']?>" class="btn btn-primary">View details</a>
              </div>
            </div>
          </div>
      <?php if(($key+1)%3==0):?>
        </div>
      </div>
      <?php endif ;?>
    <?php endforeach ;?>
          
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <?php if(isset($page)) : ?>
          <?php if($page>1) :?>
            <li class="page-item">
              <a class="page-link" href="/main/index/?page=<?= ($page-1) ?>&perPage=<?= $perPage ?>">Previous</a>
            </li>
            <?php endif; ?>
            <?php for($i=1; $i<=$pages;$i++) :?>
              <?php if($i>2 && $pages-$i>1) continue ;?>
              <?php if(isset($search)) :?>
                <li class="page-item"><a class="page-link" href="/search/index/?page=<?= $i ?>&perPage=<?= $perPage ?>&search=<?= $search ?>"><?= $i ?></a></li>
              <?php else :?>
                <li class="page-item"><a class="page-link" href="/main/index/?page=<?= $i ?>&perPage=<?= $perPage ?>"><?= $i ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>
            <?php if($page<$pages) :?>
            <li class="page-item">
              <a class="page-link" href="/main/index/?page=<?= ($page+1) ?>&perPage=<?= $perPage ?>">Next</a>
            </li>
          <?php endif; ?>
        <?php endif ; ?>  
      </ul>
    </nav>
  </body>
</html>
