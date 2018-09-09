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
<h3>Konfirmasi Bukti Transfer Pelanggan</h3>
<?php echo anchor('umkm/manage/transfer_history', 'Kembali', ['class' => 'btn btn-warning']); ?><br><br>
<table class="table table-bordered">
  <tr>
    <td width="20%">Nama Penerima</td>
    <td><input type="text" name="name" class="form-control" placeholder="Atas Nama" value="<?php echo $cart['name'] ?>" readonly></td>
  </tr>
  <tr>
    <td>Alamat Lengkap Penerima</td>
    <td><input type="text" name="address" class="form-control" placeholder="Alamat lengkap penerima" value="<?php echo $cart['address'] ?>" readonly></td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td>
        <input type="email" name="email" class="form-control" placeholder="Email penerima" value="<?php echo $cart['email'] ?>" readonly>
        <h5>* STRUK TRANSAKSI AKAN DIKIRIMKAN MELALUI EMAIL</h5>
    </td>
  </tr>
  <tr>
    <td>Nomor Telpon</td>
    <td><input type="text" name="phone" class="form-control" placeholder="Nomor telpon penerima (call, sms, whatsapp, dll)" value="<?php echo $cart['phone'] ?>" readonly></td>
  </tr>
  <tr>
    <td>Bukti Transfer</td>
    <td><img src="<?php echo base_url().'uploads/'.$cart['file_name']?>" width="120" /></td>
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
  </tr>
  <?php
  $no = 1;
  $total = 0;
  foreach ($record->result() as $r) {
    if ($r->is_discount == '1') {
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
          </tr>
          ";
          $no++;
          $total = $total + ($count);
    } else {
        echo "
          <tr>
            <td>$no</td>
            <td><h4><b>$r->name</b></h4></td>
            <td><img src=".base_url()."uploads/".$r->file_name." width='100' height='100'></td>
            <td>".rupiah($r->price)."</td>
            <td> - </td>
            <td>".angka($r->qty)."</td>
            <td>".rupiah($r->price * $r->qty)."</td>
          </tr>
          ";
          $no++;
          $total = $total + ($r->price * $r->qty);
    }
  }
  ?>
  <tr>
    <td colspan="5" align="right"><b>Total :</b></td>
    <td><b><?php echo rupiah($total); ?></b></td>
  </tr>
</table>
<script type="text/javascript">
function confirm_question() {
  return confirm('APAKAH ANDA YAKIN? PERINTAH TIDAK DAPAT DIBATALKAN!!');
}
</script>
