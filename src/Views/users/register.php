<?php if(!empty($data)) :?>
<div>
<?php foreach ($data['errors'] as $key => $value) : ?>
  <div>
    <?= $key.':'.$value ?>
  </div>
<?php endforeach ;?>
</div>
<?php endif ; ?>
<form  method="POST" action="/login/store/" class="row g-3 vstack gap-2 col-md-7 mx-auto needs-validation bg-light border border-primary rounded p-2 mb-2 mt-4">
  <div>
    <h3 class='text-center'>Register</h3>
  </div>
  <div class="col-md-5">
    <label for="validationDefault01" class="form-label">First name</label>
    <input type="text" name='name' class="form-control" id="validationDefault01" value="Mark" required>
  </div>
  <div class="col-md-5">
    <label for="validationDefault02" class="form-label">Last name</label>
    <input type="text" name='lastName' class="form-control" id="validationDefault02" value="Otto" required>
  </div>
  <div class="col-md-5">
    <label for="validationDefaultUsername" class="form-label">Username</label>
      <input type="text" name='username' class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
    </div>
  </div>
  <div class="col-md-5">
    <label for="inputEmail4" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend2">@</span>
      <input type="email" name="email" class="form-control" id="inputEmail4">
    </div>
  </div>
  <div class="col-md-5">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-5">
    <label for="inputPassword4" class="form-label">Repassword</label>
    <input type="password" name="repassword" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-5">
    <label for="validationDefault03" class="form-label">City</label>
    <input type="text" name="city" class="form-control" id="validationDefault03" required>
  </div>
  <div class="col-6">
    <div class="form-check pt-5">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
      <label class="form-check-label" for="invalidCheck2">
        <h4 class='text-semibold'>Agree to terms and conditions</h4>
      </label>
    </div>
  </div>
  <div class="col-12">
      <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>
