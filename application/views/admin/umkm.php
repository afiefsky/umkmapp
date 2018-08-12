<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Daftar UMKM Terdaftar</h1>
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
              $button_enter = anchor('admin/check_umkm/'.$r->id, 'Enter', ['class' => 'btn btn-default']);

              if ($r->is_confirmed=='0') {
                  $button_activate = anchor('admin/activate_umkm/'.$r->id, 'Activate', ['class' => 'btn btn-success']);
              } else {
                  $button_activate = '';
              }
              
              echo "
                  <tr>
                    <td>$no</td>
                    <td>$r->name</td>
                    <td><img src='".base_url()."uploads/$r->image_url' width='50'></td>
                    <td>".$button_enter." ".$button_activate."</td>
                  </tr>
              ";
          $no++;
          }
          ?>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->