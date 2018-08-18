<?php
    echo form_open('auth/admin');
    echo '<h3>' . $error . '</h3>'; // this error display the flash session set on the controller
?>
<input type="text" name="username" placeholder="Username" class="form-control" />
<input type="password" name="password" placeholder="Password" class="form-control" />
<input type="submit" name="submit" class="btn btn-default" value="Login" />
<br /><br />
<?php echo form_close(); ?>

<?php echo form_open('register'); ?>
<input type="submit" name="register" class="btn btn-default" value="REGISTER" />
<?php echo form_close(); ?>
