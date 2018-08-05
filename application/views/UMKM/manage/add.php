<?php
    $message = $this->session->flashdata('message');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Daftar UMKM Anda</h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-bar-chart-o"></i></li>
            <?php echo anchor('umkm/manage', 'UMKM') ?> > 
            <?php echo anchor('umkm/manage', 'Manage') ?> > 
            <?php echo anchor('umkm/manage/list/'.$this->session->userdata('company_id'), 'List') ?> > 
            Add
        </ol>
        <!-- CONTENTS -->
        <table class="table table-bordered">
          <tr>
            <td>Nama Produk</td>
            <td></td>
          </tr>
        </table>
        <!-- CONTENTS END -->
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->