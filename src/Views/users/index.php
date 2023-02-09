<?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'perPage.php') ?>
<?php foreach ($users as $key => $user) :?>
    <?php if(($key)%3==0):?>
        <div class="container text-center p-3 mb-2 bg-light">
        <div class="row justify-content-center p-3 mb-2">
    <?php endif ; ?>
        <?php require ('userCard.php') ?>
    <?php if(($key+1)%3==0):?>
        </div>
    </div>
    <?php endif ;?>
<?php endforeach ;?>   
<?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'pagination.php');