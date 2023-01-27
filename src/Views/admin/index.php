<!doctype html>
<html>
<?php //require_once(__DIR__.DS.'..'.DS.'main'.DS.'header.php');
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/src/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

  <div class="sidenav">
    <a href="/">Home</a>
    <a href="/admin/cars/">Cars</a>
    <a href="#clients">Users</a>
  </div>
  <div class="main">
  <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <h3>Items per page: </h3>
          <li class="page-item"><a class="page-link" href="/admin/cars/?page=1&perPage=6">6</a></li>
          <li class="page-item"><a class="page-link" href="/admin/cars/?page=1&perPage=9">9</a></li>
      </ul>
    </nav>
    <h2>Sidebar</h2>
    <?php //echo '<pre>'; print_r($data); die; ?>
    <form method="post" action="/admin/verCars/">
    <?php foreach ($cars as $key => $car) : ?>
      <?php if (($key) % 3 == 0) : ?>
        <div class="container text-center p-3 mb-2 bg-light">
          <div class="row justify-content-center p-3 mb-2">
          <?php endif; ?>
          <div class="col-4">
            <div class="card" style="width: 18rem;">
              <img src="/src/img/<?= $car['car_id'] ?>/<?= $car['default_image'] ?>" class="card-img-top" alt="...">
              <div class="card-body bg-info">
                <h5 class="card-title"><?= $car['brand'] . ' ' . $car['model'] ?></h5>
                <h5 class="card-text"> <?= $car['date_production'] ?></h5>
                <h5 class="card-text"> <?= $car['price'] ?></h5>
                <a href="/admin/showCar/<?= $car['car_id'] ?>" class="btn btn-primary">View details</a>
                  <?php if ($car['verified'] == 1) : ?>
                    <input type="checkbox" id="verified" name="verified[<?= $car['car_id'] ?>]" checked>
                  <?php else : ?>
                    <input type="checkbox" id="verified" name="verified[<?= $car['car_id'] ?>]">
                    <label for="verified"></label>
                    <?php endif; ?>
                  </div>
                  <div>
                    </div>
                  </div>
                </div>
                <?php if (($key + 1) % 3 == 0) : ?>
                </div>
              </div>
              <?php endif; ?>
              <?php endforeach; ?>
            <button type="submit">Verify</button>
          </form>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <?php if (isset($page)) : ?>
                  <?php if ($page > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="/admin/cars/?page=<?= ($page - 1) ?>&perPage=<?= $perPage ?>">Previous</a>
            </li>
          <?php endif; ?>
          <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <?php if ($i > 2 && $pages - $i > 1) continue; ?>
            <?php if (isset($search)) : ?>
              <li class="page-item"><a class="page-link" href="/search/index/?page=<?= $i ?>&perPage=<?= $perPage ?>&search=<?= $search ?>"><?= $i ?></a></li>
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="/admin/cars/?page=<?= $i ?>&perPage=<?= $perPage ?>"><?= $i ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($page < $pages) : ?>
            <li class="page-item">
              <a class="page-link" href="/admin/cars/?page=<?= ($page + 1) ?>&perPage=<?= $perPage ?>">Next</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</body>

</html>