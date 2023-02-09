<?php if(is_dir("/src/img/users/".$user['id'])) :?>
    <img src="/src/img/users/<?=$user['id']?>/<?=$user['default_img'] ?>" class="card-img-top" alt="...">
<?php else : ?>    
    <img src="/src/img/users/default.jpg" class="card-img-top" alt="...">
<?php endif ; ?> 