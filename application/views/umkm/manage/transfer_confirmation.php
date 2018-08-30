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
<h3>Halaman Konfirmasi Transfer Pelanggan</h3>
<h4><?php echo $this->session->flashdata('above_message'); ?></h4>
<h4><?php echo $this->session->flashdata('message'); ?></h4>
<table class="table table-bordered">
  <tr>
    <td><b>No</td>
    <td><b>Tanggal</td>
    <td><b>Kode</td>
    <td><b>UMKM</td>
    <td><b>Status</td>
    <td><b>Opsi</td>
  </tr>
  <?php
  $no = 1;
  $total = 0;
  $subtotal = 0;
  $button_status = '';
  foreach ($record as $r) {
    if ($r->status=='2') {
        $button_status = "<b>Menunggu Konfirmasi UMKM";
    }
    echo "<tr>
      <td>$no</td>
      <td>".hari_ini(date_format(date_create($r->created_at), 'D')).', <b>'.date_format(date_create($r->created_at), 'd-m-Y')."</td>
      <td>$r->transaction_code</td>
      <td>$r->com_name</td>
      <td>$button_status</td>
      <td>".anchor('umkm/manage/transfer_detail/'.$r->cart_id, 'Konfirmasi', ['class' => 'btn btn-primary'])."</td>
    </tr>";
    $no++;
  }
  ?>
</table>
