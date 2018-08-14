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
<h2>Selamat datang di UMKM APP</h2>
<b>Silahkan pilih UMKM sesuai dengan kebutuhan anda</b><br><br>
<table class="table table-bordered">
  <tr>
  <?php
  $no = 0;
  $counter = 2;
  foreach ($record->result() as $r) {
    $date = date_create($r->created_at);
    $day = date_format($date, 'D');
    $content_piece = "
        <td align='center' width='33.5%'>
          <u><h4>$r->name</h4></u>
          <b>$r->location</b>
          <center>
          ".anchor('shop/umkm/'.$r->id, '<img id="myImg" src='.base_url().'uploads/'.$r->image_url.' width="250" height="250" />')."
        </td>
        ";
    // echo $no;
      if ($no==$counter) {
        echo $content_piece . "</tr><tr>";
        $counter = $counter + 3;
      } else {
        echo $content_piece;
      }
      echo '
      ';
      $no++;
  }
  ?>
  </tr>
</table>
