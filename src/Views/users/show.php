<h1 class="container text-center p-3 mb-2 bg-light"> <?= $user['name'].' '.$user['last_name'] ?> </h1>
<div class="container text-center p-3 mb-2 bg-light">
  <div class="row justify-content-center p-3 mb-2">
      <div class="col-4">
        <?php include('userImg.php'); ?>
      </div>
      <div class="col-4">
          <h5 class="text-start">Username: <?= $user['username'] ?></h5> 
          <h5 class="text-start">Email: <?= $user['email'] ?></h5> 
          <h5 class="text-start">City: <?= $user['city'] ?></h5> 
      </div>
      <div class="col-4"> 
          <h5 class="text-start">Last update: <?= $user['last_update'] ?></h5> 
      </div>
      <?php if($user['id'] == $_SESSION['id']) :?>
      <div class="col">
          <a href="/login/edit/<?= $user['id']?>" class="btn btn-primary">Edit</a>
      </div>    
      <div class="col">
          <a href="/login/editEmail/<?= $user['id']?>" class="btn btn-primary">Change email</a>
      </div>    
      <div class="col">
          <a href="/login/editPassword/<?= $user['id']?>" class="btn btn-primary">Change password</a>
      </div>    
      <?php endif ; ?>
  </div>
</div>
