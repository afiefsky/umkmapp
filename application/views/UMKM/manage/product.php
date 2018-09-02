<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <!-- CONTENTS -->
        <h2>Daftar Produk UMKM <?php echo $this->session->userdata['company_name']; ?></h2>
        <?php
        if ($this->session->userdata('username')=='admin' || $this->session->userdata('username')=='superadmin') {
            echo form_open('admin/check_umkm_product');
        } else {
            echo form_open('umkm/manage/product');
        }
        ?>
        <?php
        if ($this->session->userdata('username') == 'admin') {
            echo "";
        } else {
            echo '<input type="submit" name="form_page" value="Tambah Produk" class="btn btn-success"><br /><br />';
        }
        ?>
        <?php echo form_close(); ?>
        <?php
        if ($this->session->userdata('username')=='admin' || $this->session->userdata('username')=='superadmin') {
            echo anchor('admin/check_umkm/'.$this->session->userdata('company_id'), 'Kembali', ['class' => 'btn btn-danger']);
        } else {
            echo anchor('umkm/manage/list/'.$this->session->userdata('company_id'), 'Kembali', ['class' => 'btn btn-danger']);
        }
        echo "<div align='right'>";
        echo anchor('umkm/manage/print_product', 'Print', ['class'=>'btn btn-warning', 'target'=>'_blank']);
        echo "</div>";
        ?><br><br>
        <?php
        if ($this->session->userdata('username')=='admin' || $this->session->userdata('username')=='superadmin') {
            echo form_open('admin/check_umkm_product');
        } else {
            echo form_open('umkm/manage/product');
        }
        ?>
        <table class="table table-bordered">
          <tr>
            <td><input type="text" name="keyword" class="form-control" placeholder="Masukkan nama produk"></td>
            <td><input type="submit" name="submit_search" class="btn btn-primary" value="Cari"></td>
          </tr>
          <tr>
            <td><b>* Pencarian berdasarkan nama produk</td>
          </tr>
        </table>
        <?php echo form_close(); ?>
        <table class="table table-bordered">
          <tr>
            <td><b>No</td>
            <td><b>Nama</td>
            <td><b>Stok</td>
            <td><b>Harga</td>
            <td><b>Gambar</td>
            <td><b>Opsi</td>
          </tr>
          <?php
          $no = 1 + $this->uri->segment(4);
          foreach ($record as $r) {
              if ($this->session->userdata('username')=='admin') {
                  $edit_button = '';
                  $delete_button = '';
                  $see_button = anchor('shop/product', 'Lihat Produk', ['class' => 'btn btn-primary']);
              } else {
                  $edit_button = anchor('product/edit/'.$r->id, 'Edit', ['class' => 'btn btn-info']);


                  $delete_button = anchor('product/delete/'.$r->id, 'Hapus',
                      [
                          'class' => 'btn btn-danger',
                          'onclick' => 'return confirm_delete()'
                      ]
                  );
                  $see_button = '';
              }
              echo "<tr>
                <td>$no</td>
                <td>$r->name</td>
                <td>$r->qty</td>
                <td>".rupiah($r->price)."</td>
                <td><a href='".base_url()."uploads/$r->file_name' target='_BLANK'><img src='".base_url()."uploads/$r->file_name' width='75' /></a></td>
                <td>".
                    $edit_button." ".
                    $delete_button ." ".$see_button."</td>
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

<script type="text/javascript">
function confirm_delete() {
  return confirm('APAKAH ANDA YAKIN? PERINTAH TIDAK DAPAT DIBATALKAN!!');
}
</script>

<?php echo $paging; ?>
