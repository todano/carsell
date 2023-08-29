<div class="col-4">
    <div class="card" style="width: 18rem;">
        <?php if($user['default_img']):?>
          <td><img src="/src/img/users/<?= $user['id']?>/<?= $user['default_img']?>" class="card-img-top" alt="..."></td>
        <?php else:?>
          <td><img src="/src/img/users/default.jpg" class="card-img-top" alt="..."></td>
        <?php endif ;?>
        <div class="card-body bg-info">
            <h5 class="card-title"><?= $user['name'].' '.$user['last_name'] ?></h5>
            <h5 class="card-text"> <?= $user['username'] ?></h5>
            <h5 class="card-text"> <?= $user['email'] ?></h5>
            <div class="row ">
                <?php if($data['controller'] == 'admin') :?> 
                <div class="col">    
                    <a href="/<?= $data['controller'] ?>/showUser/<?= $user['id']?>" class="btn btn-primary">View details</a>
                </div>
                <?php else : ?>
                <div class="col">    
                    <a href="/login/show/<?= $user['id']?>" class="btn btn-primary">View details</a>
                </div>
                <?php endif ;?>
                <?php if($data['controller'] == 'admin') : ?>
                <div class="col">        
                    <a href="/<?= $data['controller'] ?>/deleteUser/<?= $user['id']?>" class="btn btn-primary">Delete</a>
                </div>
                <div class="col">    
                    <?php if ($user['verified'] == 1) : ?>
                        <input type="checkbox" id="verified" name="verified[<?= $user['id'] ?>]" checked>
                    <?php else : ?>
                        <input type="checkbox" id="verified" name="verified[<?= $user['id'] ?>]">
                        <label for="verified"></label>
                    <?php endif; ?>             
                </div>
                <?php endif ?>
            </div>              
        </div>
    </div>
</div>
