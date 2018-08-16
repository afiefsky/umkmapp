<?php
    echo form_open('register/index');
    echo '<h3>' . $error . '</h3>'; // this error display the flash session set on the controller
?>
<h2>Masukkan e-mail, data akun bank anda, password, dan ketik ulang password</h2>

<input type="email" class="form-control" name="username" placeholder="nama@gmail.com" size="30" required/><br><br>
<h4>*MOHON ISIKAN DATA DENGAN SEBENAR-BENARNYA!</h4>
<input type="text" class="form-control" name="bank_account_number" placeholder="Nomor Rekening Bank Anda" size="70" required/>
<input type="text" class="form-control" name="bank_name" placeholder="Nama Bank dari Nomor Rekening Tersebut" size="70" required/>
<input type="text" class="form-control" name="bank_account_owner" placeholder="Atas Nama" size="70" required/>
<br><br>
<input type="password" name="password" placeholder="Password" class="form-control" />
<input type="password" name="re_password" placeholder="Ketik ulang password" class="form-control" />
<input type="submit" name="submit" class="btn btn-default" value="Submit" />

<?php echo form_close(); ?>

<?php echo form_open('auth'); ?>
<input type="submit" name="back" class="btn btn-default" value="Kembali" />
<?php echo form_close(); ?>
