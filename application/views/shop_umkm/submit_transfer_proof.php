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
<?php
function hari_ini($hari){
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;

        case 'Mon':
            $hari_ini = "Senin";
        break;

        case 'Tue':
            $hari_ini = "Selasa";
        break;

        case 'Wed':
            $hari_ini = "Rabu";
        break;

        case 'Thu':
            $hari_ini = "Kamis";
        break;

        case 'Fri':
            $hari_ini = "Jumat";
        break;

        case 'Sat':
            $hari_ini = "Sabtu";
        break;

        default:
            $hari_ini = "Tidak di ketahui";
        break;
    }

    return "<b>" . $hari_ini . "</b>";

}
?>
<?php echo form_open_multipart('shop_umkm/submit_transfer_proof'); ?>
<table class="table table-bordered">
  <tr>
    <td colspan="2"><h3>Halaman Form Kirim Bukti Transfer</h3></td>
  </tr>
  <tr>
    <td colspan="2"><h4>MOHON ISI DATA BERIKUT DENGAN SEBENAR-BENARNYA</h4></td>
  </tr>
  <tr>
    <td width="20%">Nama Penerima</td>
    <td><input type="text" name="name" class="form-control" placeholder="Atas Nama" required></td>
  </tr>
  <tr>
    <td>Alamat Lengkap Penerima</td>
    <td><input type="text" name="address" class="form-control" placeholder="Alamat lengkap penerima" required></td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td>
        <input type="email" name="email" class="form-control" placeholder="Email penerima" required>
        <h5>* STRUK TRANSAKSI AKAN DIKIRIMKAN MELALUI EMAIL</h5>
    </td>
  </tr>
  <tr>
    <td>Nomor Telpon</td>
    <td><input type="number" name="phone" class="form-control" placeholder="Nomor telpon penerima (call, sms, whatsapp, dll)" required></td>
  </tr>
  <tr>
    <td>Upload Struk Bukti Pembayaran</td>
    <td><input type="file" name="file_name" class="form-control" required><h5><b>* MOHON FOTO DAN PILIH FILE GAMBAR BUKTI TRANSFER</b></h5></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" class="btn btn-success" value="KIRIM"></td>
  </tr>
</table>
<?php echo form_close(); ?>
<table class="table table-bordered">
  <tr>
    <td><b>Tanggal</b></td>
    <td><b>Kode Transaksi</b></td>
  </tr>
  <tr>
    <td><?php echo hari_ini(date_format(date_create($record['created_at']), 'D')) . '<b>, '.date_format(date_create($record['created_at']), 'd-m-Y').'</b>' ?></td>
    <td>
      <?php echo $record['transaction_code']; ?>
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
  </tr>
  <?php
  $no = 1;
  $total = 0;
  foreach ($record_detail as $r) {
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
      $total = $total + $count;
  }
  ?>
  <tr>
    <td colspan="5" align="right"><b>Total :</b></td>
    <td><b><?php echo rupiah($total); ?></b></td>
  </tr>
</table>
