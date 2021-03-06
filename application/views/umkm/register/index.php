<div id="wrapper">
      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Form Tambah UMKM</h1>
            <?php echo anchor('dashboard', 'Beranda', ['class' => 'btn btn-primary']) ?><br/><br/>
            <?php echo form_open_multipart('umkm/register'); ?>
            <table class="table table-bordered">
              <tr>
                <td>Nama UMKM</td>
                <td><input type="text" name="name" class="form-control" placeholder="Masukkan nama UMKM" required></td>
              </tr>
              <tr>
                <td>Kota</td>
                <td>
                  <textarea name="location" class="form-control" required></textarea><br>
                  <b>* MOHON KETIKKAN NAMA KOTA DENGAN BENAR!!</b>
                </td>
              </tr>
              <tr>
                <td>Alamat Lengkap</td>
                <td>
                  <textarea name="location_full" class="form-control" required></textarea><br>
                  <b>* MOHON KETIKKAN ALAMAT LENGKAP DENGAN SEBENAR-BENARNYA!!</b>
                </td>
              </tr>
              <tr>
                <td>Foto</td>
                <td>
                  <input type="file" name="image" required>
                    <b>* Unggah foto UMKM</b><br />
                    <b>* Pastikan foto adalah 'toko' bagian depan UMKM anda</b>
                </td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit" name="submit" value="DAFTAR!"></td>
              </tr>
            </table>
            <?php echo form_close(); ?>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->
