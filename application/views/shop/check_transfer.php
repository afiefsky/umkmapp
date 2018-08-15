<h2>Form Cek Kode Transaksi</h2>
<h3><?php echo $this->session->flashdata('message'); ?></h3>
<?php echo form_open('shop/check_transfer'); ?>
<table class="table table-bordered">
  <tr>
    <td><h4>MOHON MASUKKAN KODE TRANSAKSI ANDA :</h4></td>
    <td width="70%"><input type="text" name="transaction_code" class="form-control"></td>
  </tr>
  <tr>
    <td align="right"></td>
    <td align="left"><input type="submit" name="submit" value="Cek" class="btn btn-primary"></td>
  </tr>
</table>
<?php echo form_close(); ?>
<h4>JIKA KODE TRANSAKSI ANDA BENAR, ANDA AKAN DIALIHKAN KE HALAMAN SUBMIT BUKTI TRANSFER</h4>
