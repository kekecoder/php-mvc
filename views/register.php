<h1>Register an Account</h1>
<?php

use app\core\form\Form;

$form = Form::begin('', 'post') ?>
<div class="row">
  <div class="col">
    <?php echo $form->field($model, 'firstname') ?>
  </div>
  <div class="col">
    <?php echo  $form->field($model, 'lastname') ?>
  </div>
</div>
<?php echo  $form->field($model, 'email') ?>
<?php echo  $form->field($model, 'password')->passwordField() ?>
<?php echo  $form->field($model, 'passwordConfirm')->passwordField() ?>
<button class="btn btn-primary">Register</button>
<?php echo form::end() ?>
<!-- <form action="" method="post">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="firstname" class="form-control">
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
</form> -->
