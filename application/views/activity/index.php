<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Daftar Aktifitas UMKM</h1>
        <?php 
            // message if needed
            if ($message!='') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {

            }
        ?>
        <?php echo anchor('activity/add', 'Tambah Kegiatan', ['class' => 'btn btn-success']); ?><br /><br />
        <table class="table table-bordered">
          <tr>
          <?php
          $no = 0;
          $counter = 2;
          foreach ($record->result() as $r) {
            $date = date_create($r->date);
            // echo $no;
              if ($no==$counter) {
                echo "
                <td align='center'>
                  $r->name<br>
                  ".date_format($date, 'l, d-m-Y')."
                  <center><a href='".base_url()."uploads/$r->file_name'><img src='".base_url()."uploads/$r->file_name' width='100' height='100' /></a>
                </td></tr><tr>
                ";
                $counter = $counter + 3;
              } else {
                echo "
                <td align='center'>
                  $r->file_name<br>
                  ".date_format($date, 'l, d-m-Y')."
                  <center><a href='".base_url()."uploads/$r->file_name'><img src='".base_url()."uploads/$r->file_name' width='100' height='100' /></a>
                </td>
                ";
              }
              $no++;
          }
          ?>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->