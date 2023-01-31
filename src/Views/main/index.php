<?php //echo '<pre>'; print_r($_GET);  ?>
<!doctype html>
<html>
  <?php require_once('header.php');?>
  <body>
    <?php if(isset($_GET['msg'])) :?>
      <h5 class="text-success"><?= $_GET['msg']; ?></h5>
    <?php endif ;?> 
    <h2 class="text-center"> Here you can choose between many models, which will fits best to you</h2>
    <?php require_once('perPage.php'); ?>
    <?php if(empty($data['cars']['msg']))  :?>
      <?php foreach ($cars as $key => $car) :?>
        <?php if(($key)%3==0):?>
          <div class="container text-center p-3 mb-2 bg-light">
            <div class="row justify-content-center p-3 mb-2">
            <?php endif ; ?>
            <?php require ('card.php') ?>
        <?php if(($key+1)%3==0):?>
          </div>
        </div>
        <?php endif ;?>
      <?php endforeach ;?>   
    <?php else :?>  
      <div class="container text-center p-3 mb-2 bg-light">
        <div class="row justify-content-center p-3 mb-2">
          <div class="col-4">
            <label><?= $data['cars']['msg'] ?></label>
          </div>
        </div>
      </div>  
    <?php endif ;?>  
    <?php require_once('pagination.php'); ?>
  </body>
</html>
