<?php
    $message = $this->session->flashdata('message');
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
        <?php echo anchor('admin/umkm', 'Kembali', ['class' => 'btn btn-danger']); ?><br><br>
        <!-- CONTENTS BELOW -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2"><img src="<?php echo base_url() . 'uploads/' . $record['image_url']; ?>" width="250" /></td>
          </tr>
          <tr>
            <td><b><?php echo $record['name']; ?></b></td>
            <td>
            <?php
            if ($this->session->userdata('username') == 'admin') {
                echo anchor('admin/check_umkm_product', 'Cek Produk', ['class' => 'btn btn-info']);
            } else {
                echo anchor('umkm/manage/product', 'Kelola Produk', ['class' => 'btn btn-info']);
                echo " ";
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
