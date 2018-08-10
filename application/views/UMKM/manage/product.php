<?php
    $message = $this->session->flashdata('message');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>
        <?php
        if ($this->session->userdata['username'] == 'admin') {
            echo "Daftar UMKM terdaftar";
        } else {
            echo "Daftar UMKM Anda";
        }
        ?>
        </h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-bar-chart-o"></i></li>
            <?php echo anchor('umkm/manage', 'UMKM') ?> > 
            <?php echo anchor('umkm/manage', 'Manage') ?> > 
            <?php echo anchor('umkm/manage/list/'.$this->session->userdata('company_id'), 'List') ?> > 
            Manage
        </ol>
        <!-- CONTENTS -->
        <h2>Daftar Produk</h2>
        <?php
        echo form_open('umkm/manage/product');
        ?>
        <?php
        if ($this->session->userdata['username'] == 'admin') {
            echo "";
        } else {
            echo '<input type="submit" name="form_page" value="Tambah Produk" class="btn btn-success"><br /><br />';
        }
        ?>
        <?php echo form_close(); ?>
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Qty</td>
            <td>Gambar</td>
            <td>Opsi</td>
          </tr>
          <?php
          $no = 1;
          foreach ($record as $r) {
              if ($this->session->userdata['username']=='admin') {
                  $edit_button = '';
                  $delete_button = '';
              } else {
                  $edit_button = anchor('product/edit/'.$r->id, 'Edit', ['class' => 'btn btn-info']);
                  $delete_button = anchor('product/delete/'.$r->id, 'Hapus', ['class' => 'btn btn-danger']);
              } 
              echo "<tr>
                <td>$no</td>
                <td>$r->name</td>
                <td>$r->qty</td>
                <td><a href='".base_url()."uploads/$r->file_name' target='_BLANK'><img src='".base_url()."uploads/$r->file_name' width='75' /></a></td>
                <td>".
                    $edit_button." ".
                    $delete_button
                ."</td>
              </tr>";
          $no++;
          }
          ?>
        </table>
        <!-- CONTENTS END -->
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->