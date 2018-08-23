<h3>Profil Anda</h3>
<?php echo '<h4>'.$this->session->flashdata('message').'</h4>'; ?>
<table class="table table-bordered">
  <tr>
    <td width="30%">Email</td>
    <td><input type="text" name="username" value="<?php echo $record['username']; ?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td>No HP</td>
    <td><input type="text" name="phone" value="<?php echo $record['phone']; ?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td>Bank - No Rek</td>
    <td><input type="text" name="bank_account_number" value="<?php echo $record['bank_account_number']; ?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td>Bank - Nama Bank</td>
    <td><input type="text" name="bank_name" value="<?php echo $record['bank_name']; ?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td>Bank - A/N</td>
    <td><input type="text" name="bank_account_owner" value="<?php echo $record['bank_account_owner']; ?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?php echo $record['password']; ?>" class="form-control" readonly><br/><b>* DIRAHASIAKAN</b></td>
  </tr>
  <tr>
    <td></td>
    <td><?php echo anchor('profile/edit/'.$this->session->userdata('user_id'), 'Edit', ['class'=>'btn btn-primary']); ?></td>
  </tr>
</table>
