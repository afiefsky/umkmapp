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
<h2>Halaman Kirim Bukti Transfer</h2>
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
