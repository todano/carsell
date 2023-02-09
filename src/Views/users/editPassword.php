<form  method="POST" action="/login/updatePassword/<?= $user['id']?>" class="row g-3 vstack gap-2 col-md-7 mx-auto needs-validation bg-light border border-primary rounded p-2 mb-2 mt-4">
  <div>
    <h3 class='text-center'>Change password</h3>
  </div>
  <div class="col-md-5">
    <label for="inputPassword4" class="form-label">New password</label>
    <input type="password" name="oldPassword" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-5">
    <label for="inputPassword4" class="form-label">New password</label>
    <input type="password" name="newPassword" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-5">
    <label for="inputPassword4" class="form-label">Repassword</label>
    <input type="password" name="repassword" class="form-control" id="inputPassword4">
  </div>
  <div class="col-12">
      <button class="btn btn-primary" type="submit">Update</button>
  </div>
</form>
