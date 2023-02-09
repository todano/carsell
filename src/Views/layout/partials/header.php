<?php //echo '<pre>'; print_r($data); ?>
<head >
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
  <title class="text center">Welcome to our website for best cars</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="src/css/style.css"> -->
  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <?php if($_SESSION) :?>
        <a class="navbar-brand" href="/login/show/<?= $_SESSION['id'] ?>"><?= $_SESSION['name'] ?></a>
      <?php else :?>  
        <a class="navbar-brand" href="#">WELCOME</a>
      <?php endif ; ?>  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <?php if(empty($_SESSION)) :?>
          <li class="nav-item">
            <a class="nav-link" href="/login/create">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login/sign">Login</a>
          </li>
          <?php else :?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/cars/create">Add advertisment</a></li>
              <?php if(isset($_SESSION) && $_SESSION['role'] == 'admin' ) :?>
                <li><a class="dropdown-item" href="/admin/cars/">Admin panel</a></li>
              <?php endif ;?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="nav-link" href="/login/destroy">Logout</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login/index/">Users</a>
          </li>
          <?php endif ;?>
          <li class="nav-item">
            <h5 class="text-center text-sm px-4"> Here you can choose between many models, which will fits best to you</h5>
          </li>
        </ul>
        <form method="POST" action="/search/index/" class="d-flex" role="search">
          <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</head>
