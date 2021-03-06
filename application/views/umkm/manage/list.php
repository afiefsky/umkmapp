<?php
    $message = $this->session->flashdata('message');
?>
<?php
function hari_ini($hari)
{
    switch ($hari) {
        case 'Sun':
            $hari_ini = 'Minggu';
        break;

        case 'Mon':
            $hari_ini = 'Senin';
        break;

        case 'Tue':
            $hari_ini = 'Selasa';
        break;

        case 'Wed':
            $hari_ini = 'Rabu';
        break;

        case 'Thu':
            $hari_ini = 'Kamis';
        break;

        case 'Fri':
            $hari_ini = 'Jumat';
        break;

        case 'Sat':
            $hari_ini = 'Sabtu';
        break;

        default:
            $hari_ini = 'Tidak di ketahui';
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
            if ($message != '') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {
            }
        ?>
        <?php
        if ($this->session->userdata('username') == 'admin' || $this->session->userdata('username') == 'superadmin') {
            echo anchor('admin/umkm', 'Kembali', ['class' => 'btn btn-danger']);
        } else {
            echo anchor('umkm/manage', 'Kembali', ['class' => 'btn btn-danger']);
        }
        ?><br><br>
        <!-- CONTENTS BELOW -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2"><img src="<?php echo base_url().'uploads/'.$record['image_url']; ?>" width="250" /></td>
          </tr>
          <tr>
            <td><b>Nama Toko:</td>
            <td><?php echo $record['name']; ?></td>
          </tr>
          <tr>
            <td><b>Nama Pemilik:</td>
            <td><?php echo $record['bank_account_owner']; ?></td>
          </tr>
          <tr>
            <td><b>Kota:</td>
            <td><?php echo $record['location']; ?></td>
          </tr>
          <tr>
            <td><b>Alamat Lengkap:</td>
            <td><?php echo $record['location_full']; ?></td>
          </tr>
          <tr>
            <td><b>No. HP:</td>
            <td><?php echo $record['phone']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal Dibuat:</td>
            <td><?php echo '<b>'.hari_ini(date_format(date_create($record['created_at']), 'D')).', '.date_format(date_create($record['created_at']), 'd-m-Y').'</b>'; ?></td>
          </tr>
          <tr>
              <td><b>Opsi:</td>
              <td>
                <?php
                if ($this->session->userdata('username') == 'admin') {
                    echo anchor('admin/check_umkm_product', 'Cek Produk', ['class' => 'btn btn-info']);
                    echo ' ';
                    echo anchor('admin/check_umkm_activity', 'Cek Kegiatan', ['class' => 'btn btn-success']);
                } else {
                    echo anchor('umkm/manage/product', 'Kelola Produk', ['class' => 'btn btn-info']);
                    echo ' ';
                    echo anchor('activity', 'Kelola Kegiatan', ['class' => 'btn btn-success']);
                }
                ?>
             </td>
          </tr>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
