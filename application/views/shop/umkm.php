<?php
    $message = $this->session->flashdata('message');
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

    return "$hari_ini";

}
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>UMKM <?php echo $record['name']; ?></h1>
        <?php
            $this->session->set_userdata('company_name', $record['name']);
            if ($message!='') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {

            }
        ?>
        <?php echo anchor('shop', 'Kembali', ['class' => 'btn btn-warning']); ?><br/><br/>
        <!-- CONTENTS BELOW -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2"><img src="<?php echo base_url() . 'uploads/' . $record['image_url']; ?>" width="250" /></td>
          </tr>
          <tr>
            <td><b>Nama:</td>
            <td><?php echo $record['name']; ?></td>
          </tr>
          <tr>
            <td><b>Pemilik:</td>
            <td><?php echo $record['bank_account_owner']; ?></td>
          </tr>
          <tr>
            <td><b>Kota:</td>
            <td><?php echo $record['location']; ?></td>
          </tr>
          <tr>
            <td><b>Kontak:</td>
            <td><?php echo $record['phone']; ?></td>
          </tr>
          <tr>
            <td><b>Alamat Lengkap:</td>
            <td><?php echo $record['location_full']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal Dibuat:</td>
            <td><?php echo hari_ini(date_format(date_create($record['created_at']), 'D')).', '.date_format(date_create($record['created_at']), 'd-m-Y'); ?></td>
          </tr>
          <tr>
              <td><b>Opsi:</td>
              <td>
                <?php
                echo anchor('shop/product', 'Belanja', ['class' => 'btn btn-info']);
                echo " ";
                echo anchor('shop/activity', 'Lihat Kegiatan', ['class' => 'btn btn-success']);
                ?>
             </td>
          </tr>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

