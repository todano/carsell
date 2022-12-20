<html>
  <?php require_once('E:\xampp\htdocs\carsell\src\Views\main\header.php'); ?>
  <body>
      <form  method="POST" action="/login/signIn/" class="row g-3 vstack gap-2 col-md-5 mx-auto bg-light border border-primary rounded p-2 mb-2 mt-4">
        <div>
          <h3 class='text-center'>Login</h3>
        </div>
        <div class="col-md-5">
          <label for="inputEmail4" class="form-label">
            <h4>Email</h4>
          </label>
          <input type="email" name="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-5">
          <label for="inputPassword4" class="form-label">
            <h4>Password</h4>
          </label>
          <input type="password" name="password" class="form-control" id="inputPassword4">
        </div>
        <div class="col-mb-2">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
      </form>
  </body>
</html>
