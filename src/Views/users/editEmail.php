<form  method="POST" action="/login/updateEmail/<?= $user['id']?>" class="row g-3 vstack gap-2 col-md-7 mx-auto needs-validation bg-light border border-primary rounded p-2 mb-2 mt-4">
  <div>
    <h3 class='text-center'>Change your email</h3>
  </div>
  <div class="col-md-5">
    <label for="inputEmail4" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend2">@</span>
      <input type="email" name="email" class="form-control" id="inputEmail4">
    </div>
  </div>
  <div class="col-12">
      <button class="btn btn-primary" type="submit">Update</button>
  </div>
</form>
