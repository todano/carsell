    <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= $data['msg'] ;?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    <?php if(isset($_GET['msg'])) :?>
      <h5 class="text-success"><?= $_GET['msg']; ?></h5>
    <?php endif ;?> 
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
 