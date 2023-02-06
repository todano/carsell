<div class="col-4">
    <div class="card" style="width: 18rem;">
    <img src="/src/img/cars/<?=$user['car_id']?>/<?=$user['default_image'] ?>" class="card-img-top" alt="...">
        <div class="card-body bg-info">
            <h5 class="card-title"><?= $user['name'].' '.$user['lastName'] ?></h5>
            <h5 class="card-text"> <?= $user['username'] ?></h5>
            <h5 class="card-text"> <?= $user['email'] ?></h5>
            <div class="row ">
                <div class="col">    
                    <a href="/main/show/<?= $user['id']?>" class="btn btn-primary">View details</a>
                </div>
                <?php if($data['controller'] == 'admin') : ?>
                <div class="col">        
                    <a href="/<?= $data['controller'] ?>/deleteCar/<?= $car['car_id']?>" class="btn btn-primary">Delete</a>
                </div>
                <div class="col">    
                    <?php if ($car['verified'] == 1) : ?>
                        <input type="checkbox" id="verified" name="verified[<?= $car['car_id'] ?>]" checked>
                    <?php else : ?>
                        <input type="checkbox" id="verified" name="verified[<?= $car['car_id'] ?>]">
                        <label for="verified"></label>
                    <?php endif; ?>             
                </div>
                <?php endif ?>
            </div>              
        </div>
    </div>
</div>