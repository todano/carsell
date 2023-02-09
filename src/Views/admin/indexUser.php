<div class="main">
  <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'perPage.php'); ?>
  <form method="post" action="/admin/verUsers/">
    <?php foreach ($users as $key => $user) : ?>
      <?php if (($key) % 3 == 0) : ?>
        <div class="container text-center p-3 mb-2 bg-light">
          <div class="row justify-content-center p-3 mb-2">
      <?php endif; ?>
            <?php require (__DIR__.DS.'..'.DS.'users'.DS.'userCard.php'); ?>
      <?php if (($key + 1) % 3 == 0) : ?>
        </div>
      </div>
      <?php endif; ?>
    <?php endforeach; ?>
    <button class="btn btn-primary" type="submit">Verify</button>
  </form>
  <?php require_once(__DIR__.DS.'..'.DS.'main'.DS.'pagination.php'); ?>
</div>
