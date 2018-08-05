<?php
    echo form_open('register/index');
    echo '<h3>' . $error . '</h3>'; // this error display the flash session set on the controller
?>
<h2>Masukkan username, password, dan ketik ulang password</h2>

<input type="text" name="username" placeholder="Username" class="form-control" />
<input type="password" name="password" placeholder="Password" class="form-control" />
<input type="password" name="re_password" placeholder="Ketik ulang password" class="form-control" />
<input type="submit" name="submit" class="btn btn-default" value="Submit" />
<br /><br />
<?php echo form_close(); ?>

<?php echo form_open('auth'); ?>
<input type="submit" name="back" class="btn btn-default" value="Kembali" />
<?php echo form_close(); ?>