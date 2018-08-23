<?php echo form_open('profile/edit/'.$this->uri->segment(3)); ?>
<h3>Profil Anda</h3>
<?php echo '<h3>'.$this->session->flashdata('message').'</h3>'; ?>
<table class="table table-bordered">
  <tr>
    <td width="30%">Email / Username</td>
    <td><input type="email" name="username" value="<?php echo $record['username']; ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>No HP</td>
    <td><input type="number" name="phone" value="<?php echo $record['phone']; ?>" class="form-control"></td>
  </tr>
  <tr>
      <td bgcolor="black"></td>
      <td bgcolor="black"></td>
  </tr>
  <tr>
    <td>Bank - No Rek</td>
    <td><input type="number" name="bank_account_number" value="<?php echo $record['bank_account_number']; ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Bank - Nama Bank</td>
    <td><input type="text" name="bank_name" value="<?php echo $record['bank_name']; ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Bank - A/N</td>
    <td><input type="text" name="bank_account_owner" value="<?php echo $record['bank_account_owner']; ?>" class="form-control"></td>
  </tr>
  <tr>
      <td bgcolor="black"></td>
      <td bgcolor="black"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?php echo $record['password']; ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Ketik Ulang Password</td>
    <td><input type="password" name="re_password" value="<?php echo $record['password']; ?>" class="form-control"><br/><b>* DIRAHASIAKAN</b></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
  </tr>
</table>
