<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Form Tambah Aktivitas</h1>
        <?php echo anchor($this->session->userdata('active_page'), 'Kembali', ['class' => 'btn btn-warning']); ?><br /><br />
        <?php echo form_open_multipart('activity/edit/'.$this->uri->segment(3)); ?>
        <table class="table table-bordered">
          <tr>
            <td>Nama Kegiatan</td>
            <td><input type="text" name="name" placeholder="Masukkan nama kegiatan" value="<?php echo $record['name'] ?>" class="form-control" required></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td><input type="date" name="date" placeholder="Pilih tanggal" value="<?php echo $record['date'] ?>" required></td>
          </tr>
          <tr>
            <td>Foto</td>
            <td>
                <?php
                if ($edit_pic == 0) {
                    echo '<input type="submit" name="request_pic_edit" class="btn btn-info" value="Ubah Foto">';
                } else {
                    echo '<input type="file" name="file_name" placeholder="Pilih file" class="form-control" required><br />';
                    echo anchor('activity/edit/'.$this->uri->segment(3), 'Batal', ['class'=>'btn btn-danger']);
                }
                ?>
            </td>
          </tr>
          <tr>
            <td>Keterangan Singkat</td>
            <td>
                <textarea rows="4" cols="50" name="description" required><?php echo $record['description']; ?></textarea><br><b>
            </td>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </td>
          </tr>
        </table>
        <?php echo form_close(); ?>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
