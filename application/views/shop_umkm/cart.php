<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function angka($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3>Keranjang Anda</h3>
<?php echo anchor('shop_umkm/product', 'Kembali', ['class' => 'btn btn-warning']); ?><br><br>
<?php echo form_open('shop_umkm/process'); ?>
<table class="table table-bordered">
  <tr>
    <td>Email</td>
    <td><input type="email" name="email" class="form-control" placeholder="Masukkan email anda" value="<?php echo $this->session->userdata('username'); ?>" required readonly></td>
  </tr>
  <tr>
    <td colspan="2">
      <h4>MOHON ISI ALAMAT EMAIL YANG VALID!!! AKAN DIGUNAKAN UNTUK NOTIFIKASI PEMBERITAHUAN!!!</h4>
    </td>
  </tr>
</table>
<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Gambar</th>
    <th>Harga</th>
    <th>Diskon</th>
    <th>Qty</th>
    <th>Sub Total</th>
    <th>Opsi</th>
  </tr>
  <?php
  $no = 1;
  $total = 0;
  foreach ($record->result() as $r) {
      $count = ($r->price - (($r->price * 15) / 100)) * $r->qty;
      echo "
      <tr>
        <td>$no</td>
        <td><h4><b>$r->name</b></h4></td>
        <td><img src=".base_url()."uploads/".$r->file_name." width='100' height='100'></td>
        <td>".rupiah($r->price)."</td>
        <td>15%</td>
        <td>".angka($r->qty)."</td>
        <td>".rupiah($count)."</td>
        <td>".anchor('shop_umkm/cancel_product/'.$r->detail_id, 'Cancel', ['class' => 'btn btn-danger'])."</td>
      </tr>
      ";
      $no++;
      $total = $total + $count;
  }
  ?>
  <tr>
    <td colspan="5" align="right"><b>Total :</b></td>
    <td><b><?php echo rupiah($total); ?></b></td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td align="left">
      <?php
      if (empty($this->session->userdata('cart_id'))) {
          $out_button = 'SILAHKAN MEMBELI SEBELUM CEKOUT';
      } else {
          // $out_button = anchor('shop/process', 'Cek-out dan BAYAR', ['class' => 'btn btn-success']);
          $out_button = "<input type='submit' name='submit' value='Submit' class='btn btn-primary'>";
      }
      echo $out_button;
      ?>
    </td>
  </tr>
</table>
<?php echo form_close(); ?>
