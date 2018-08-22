<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
    $username = $this->session->userdata('username');
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
<h2>Selamat datang di Halaman Produk UMKM <?php echo $this->session->userdata('company_name'); ?></h2>
<b>Silahkan pilih produk sesuai dengan kebutuhan anda</b><br><br>
<?php
if ($username=='admin' || $username=='superadmin') {
    echo anchor('shop/cart/'.$this->session->userdata('cart_id'), 'Cek Keranjang', ['class' => 'btn btn-primary', 'disabled'=>'true']);
} else {
    echo anchor('shop/cart/'.$this->session->userdata('cart_id'), 'Cek Keranjang', ['class' => 'btn btn-primary']);
}
?>
<table width="100%">
  <tr>
    <td align="right">
    <?php
        if ($username=='admin'||$username=='superadmin') {
            echo anchor('umkm/manage/product', 'KEMBALI', ['class' => 'btn btn-warning']).' ';
            echo anchor('shop/logout', 'KELUAR', ['class' => 'btn btn-danger', 'disabled'=>'true']);
        } else {
            echo anchor('shop/logout', 'KELUAR', ['class' => 'btn btn-danger']);
        }
    ?>
    </td>
  </tr>
</table><br>
<table class="table table-bordered">
  <tr>
  <?php
  $no = 0;
  $counter = 2;
  foreach ($record->result() as $r) {
    $date = date_create($r->created_at);
    $day = date_format($date, 'D');

    if ($r->qty == 0 || $r->qty <= 0) {
        $button_add = anchor('shop/qty_selection/'.$r->id, 'Stok Kosong', ['class' => 'btn btn-danger', 'disabled' => 'true']);
    } else {
        if ($username=='admin'||$username=='superadmin') {
            $button_add = anchor('shop/qty_selection/'.$r->id, 'Tambah ke Keranjang', ['class' => 'btn btn-primary', 'disabled'=>'true']);
        }
    }
    $content_piece = "
        <td align='center' width='33.5%'>
          <u><h4>$r->name</h4></u>
          <center>
          ".'<img id="myImg" src='.base_url().'uploads/'.$r->file_name.' width="150" height="150" target="_blank" />'."
          <h4>".rupiah($r->price)."</h4>
          ".$button_add."
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
