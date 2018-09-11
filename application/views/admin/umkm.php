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
            $startDate = strtotime($r->last_logged_in);
            $endDate = strtotime(date('Y-m-d H:i:s'));

            $numberOfMonths = abs((date('Y', $endDate) - date('Y', $startDate))*12 + (date('m', $endDate) - date('m', $startDate)))+1;
              $button_enter = anchor('admin/check_umkm/'.$r->id, 'Enter', ['class' => 'btn btn-default']);

              if ($r->is_confirmed=='0') {
                  $button_confirm = anchor('admin/activate_umkm/'.$r->id, 'Konfirm', ['class' => 'btn btn-success']);
              } else {
                  $button_confirm = '';
              }
              if ($r->is_active=='0') {
                  $third_button = anchor('admin/activate_umkm_alternate/'.$r->id, 'Activate', ['class' => 'btn btn-success']);
              } else {
                  $third_button = anchor('admin/deactivate_umkm_alternate/'.$r->id, 'Deactivate', ['class' => 'btn btn-danger']);
              }

              $numberOfMonths > 1 ? $status = 'Aktif' : $status = 'Pasif';
              echo "
                  <tr>
                    <td>$no</td>
                    <td>$r->name</td>
                    <td><img src='".base_url()."uploads/$r->image_url' width='50'></td>
                    <td>".$button_enter." ".$button_confirm." ".$third_button."</td>
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
