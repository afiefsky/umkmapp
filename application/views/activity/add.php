<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Form Tambah Aktivitas</h1>
        <?php echo anchor('activity', 'Kembali', ['class' => 'btn btn-warning']); ?><br /><br />
        <?php echo form_open_multipart('activity/add'); ?>
        <table class="table table-bordered">
          <tr>
            <td>Nama Kegiatan</td>
            <td><input type="text" name="name" placeholder="Masukkan nama kegiatan" class="form-control" required></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td><input type="date" name="date" placeholder="Pilih tanggal" required></td>
          </tr>
          <tr>
            <td>Foto</td>
            <td><input type="file" name="file_name" placeholder="Pilih file" class="form-control" required></td>
          </tr>
          <tr>
            <td>Keterangan Singkat</td>
            <td>
                <textarea rows="4" cols="50" name="description" required>
                    Mohon isikan keterangan singkat
                </textarea>
            </td>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <input type="submit" name="submit" class="btn btn-success">
            </td>
          </tr>
        </table>
        <?php echo form_close(); ?>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
