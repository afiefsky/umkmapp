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
<?php echo anchor('shop/product', 'Kembali', ['class' => 'btn btn-warning']); ?><br><br>
<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Gambar</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Sub Total</th>
    <th>Opsi</th>
  </tr>
  <?php
  $no = 1;
  $total = 0;
  foreach ($record->result() as $r) {
      echo "
      <tr>
        <td>$no</td>
        <td><h4><b>$r->name</b></h4></td>
        <td><img src=".base_url()."uploads/".$r->file_name." width='100' height='100'></td>
        <td>".rupiah($r->price)."</td>
        <td>".angka($r->qty)."</td>
        <td>".rupiah($r->price * $r->qty)."</td>
        <td>".anchor('shop/cancel_product/'.$r->detail_id, 'Cancel', ['class' => 'btn btn-danger'])."</td>
      </tr>
      ";
      $no++;
      $total = $total + ($r->price * $r->qty);
  }
  ?>
  <tr>
    <td colspan="5" align="right"><b>Total :</b></td>
    <td><b><?php echo rupiah($total); ?></b></td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td align="left">
      <?php echo anchor('', 'Cek-out dan BAYAR', ['class' => 'btn btn-success']); ?>
    </td>
  </tr>
</table>
