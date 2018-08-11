<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
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
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Img</th>
            <th>Opsi</th>
          </tr>
          <?php
          $no = 1;
          foreach ($record as $r) {
            if ($r->is_confirmed=='0') {
              $button = 'MOHON TUNGGU KONFIRMASI ADMIN';
            } else {
              $button = anchor('UMKM/manage/list/'.$r->company_id, 'Enter', ['class' => 'btn btn-default']);
            }
              echo "
                  <tr>
                    <td>$no</td>
                    <td>$r->name</td>
                    <td><img src='".base_url()."uploads/$r->image_url' width='50'></td>
                    <td>".$button."</td>
                  </tr>
              ";
          }
          $no++;
          ?>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->