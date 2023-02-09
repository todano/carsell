<?php if(!empty($data['msg'])) :?>
  <div>
  <?php foreach ($data['msg'] as $key => $value) : ?>
    <div class='text-danger'>
      <?= $key.':'.$value ?>
    </div>
  <?php endforeach ;?>
</div>
<?php endif ; ?>
<form  method="POST" action="/login/update/<?= $user['id']?>" class="row g-3 vstack gap-2 col-md-7 mx-auto needs-validation bg-light border border-primary rounded p-2 mb-2 mt-4">
  <div>
    <h3 class='text-center'>Edit your profile</h3>
  </div>
  <div class="col-md-5">
    <label for="validationDefault01" class="form-label">First name</label>
    <input type="text" name='name' class="form-control" id="validationDefault01" value="<?= $user['name'] ?>" >
  </div>
  <div class="col-md-5">
    <label for="validationDefault02" class="form-label">Last name</label>
    <input type="text" name='lastName' class="form-control" id="validationDefault02" value="<?= $user['last_name'] ?>" >
  </div>
  <div class="col-md-5">
    <label for="validationDefaultUsername" class="form-label">Username</label>
      <input type="text" name='username' class="form-control" id="validationDefaultUsername"  value="<?= $user['username'] ?>" aria-describedby="inputGroupPrepend2" >
    </div>
  </div>
  <div class="col-md-5">
    <label for="validationDefault03" class="form-label">City</label>
    <input type="text" name="city" class="form-control" id="validationDefault03" value="<?= $user['city'] ?>" >
  </div>
  <div class="col-12">
      <button class="btn btn-primary" type="submit">Update</button>
  </div>
</form>
