<!doctype html>
<html>
<?php //echo '<pre>'; print_r($data); die;?>

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
  <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'perPage.php'); ?>
    <h2>Sidebar</h2>
    <?php //echo '<pre>'; print_r($data); die; ?>
    <form method="post" action="/admin/verCars/">
      <?php foreach ($cars as $key => $car) : ?>
        <?php if (($key) % 3 == 0) : ?>
          <div class="container text-center p-3 mb-2 bg-light">
            <div class="row justify-content-center p-3 mb-2">
        <?php endif; ?>
              <?php require (__DIR__.DS.'..'.DS.'main'.DS.'card.php'); ?>
        <?php if (($key + 1) % 3 == 0) : ?>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <button type="submit">Verify</button>
    </form>
    <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'pagination.php'); ?>
  </div>
</body>

</html>