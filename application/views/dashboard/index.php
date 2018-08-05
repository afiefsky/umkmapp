<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Beranda</h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-dashboard"></i> Beranda</li>
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
        <?php if ($num_rows_companies == 0) { ?>
            Selamat datang di Beranda UMKM-APP! Anda belum memiliki UMKM, buat UMKM anda di <?php echo anchor('UMKM/register', 'sini!'); ?>
        <?php } else { ?>
            Selamat datang di Beranda UMKM-APP! Kelola UMKM yang sudah anda buat di <?php echo anchor('UMKM/manage', 'sini!'); ?><br />
            Atau buat UMKM baru anda di <?php echo anchor('UMKM/register', 'sini!'); ?>
        <?php } ?>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->