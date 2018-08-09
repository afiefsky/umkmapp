
<?php echo form_open('auth'); ?>
<!-- <input type="submit" name="back" class="btn btn-default" value="Kembali" /> -->
<?php echo form_close(); ?>

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
        <?php
            echo form_open_multipart('umkm/manage/product');
        ?>
        <table class="table table-bordered">
        <tr>
            <td>Nama Barang</td>
            <td><input type="text" name="name" class="form-control"></td>
        </tr>        
        <tr>
            <td>Qty</td>
            <td><input type="number" name="qty" class="form-control"></td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td><input type="file" name="gambar"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit"></td>
        </tr>
        </table>
        <?php echo form_close(); ?>
        <!-- CONTENTS END -->
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->