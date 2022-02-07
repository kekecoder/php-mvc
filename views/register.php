<h1>Register Page</h1>
<form action="" method="post">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="firstname" class="form-control" value="<?php echo $model->firstname?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="lastname" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="">Email</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <label for="">Confirm Password</label>
    <input type="password" class="form-control" name="passwordConfirm">
  </div>
  <button class="btn btn-success">Register</button>
</form>