<!doctype html>
<html>
<?php// echo '<pre>'; print_r($data); die; ?>
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
    <h2>Sidebar</h2>
    <?php //echo '<pre>'; print_r($data); die; ?>
    <form method="post" action="/admin/verCars/">
        <h1 class="container text-center p-3 mb-2 bg-light"> <?= $car['brand'].' '.$car['model'] ?> </h1>
        <div class="container text-center p-3 mb-2 bg-light">
            <div class="row justify-content-center p-3 mb-2">
            <div class="col-4">
                <img src="/src/img/<?=$car['car_id']?>/<?=$car['default_image'] ?>" class="card-img-top" alt="...">
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
        </div>
        <?php if ($car['verified'] == 1) : ?>
            <input type="checkbox" id="verified" name="verified['<?= $car['car_id'] ?>']" checked>
        <?php else : ?>
            <input type="checkbox" id="verified" name="verified['<?= $car['car_id'] ?>']">
            <label for="verified"></label>
        <?php endif; ?>
     <button type="submit">Verify</button>
    </form>
  </div>
</body>

</html>