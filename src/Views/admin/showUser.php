<form method="post" action="/admin/verUsers/">
<h1 class="container text-center p-3 mb-2 bg-light"> <?= $user['name'].' '.$user['last_name'] ?> </h1>
    <div class="container text-center p-3 mb-2 bg-light">
        <div class="row justify-content-center p-3 mb-2">
            <div class="col-4">
                <?php include(__DIR__.DS.'..'.DS.'users'.DS.'userImg.php'); ?>
            </div>
            <div class="col-4">
                <h5 class="text-start">Username: <?= $user['username'] ?></h5> 
                <h5 class="text-start">Email: <?= $user['email'] ?></h5> 
                <h5 class="text-start">City: <?= $user['city'] ?></h5> 
            </div>
            <div class="col-4"> 
                <h5 class="text-start">Last update: <?= $user['last_update'] ?></h5> 
            </div>
            <div class="col">
            <?php if ($user['verified'] == 1) : ?>
                <input type="checkbox" id="verified" name="verified['<?= $user['id'] ?>']" checked>
            <?php else : ?>
                <input type="checkbox" id="verified" name="verified['<?= $user['id'] ?>']">
                <label for="verified"></label>
            <?php endif; ?>
            <button class="btn btn-primary" type="submit">Verify</button>
            </div>
            <div class="col">
                <a href="/login/show/<?= $user['id']?>" class="btn btn-primary">View details</a>
            </div>    
        </div>
    </div>
</form>