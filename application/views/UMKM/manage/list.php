<?php
    $message = $this->session->flashdata('message');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Daftar UMKM Anda</h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-bar-chart-o"></i> UMKM</li>
        </ol>
        <?php 
            if ($message!='') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {

            }
        ?>
        <!-- CONTENTS BELOW -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2"><img src="<?php echo base_url() . 'uploads/' . $record['image_url']; ?>" width="250" /></td>
          </tr>
          <tr>
            <td><b><?php echo $record['name']; ?></b></td>
            <td><?php echo anchor('umkm/manage/product', 'Manage Product', ['class' => 'btn btn-default']); ?></td>
          </tr>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->