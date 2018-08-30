<?php echo form_open('auth'); ?>
<!-- <input type="submit" name="back" class="btn btn-default" value="Kembali" /> -->
<?php echo form_close(); ?>

<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Form Tambah Produk</h1>
        <?php echo anchor('umkm/manage/product', 'Kembali', ['class' => 'btn btn-danger']); ?><br/><br/>
        <?php
            if ($message!='') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {

            }
        ?>
        <!-- CONTENTS BELOW -->
        <?php
            echo form_open_multipart('umkm/manage/product');
        ?>
        <table class="table table-bordered">
        <tr>
            <td>Nama Barang</td>
            <td><input type="text" name="name" class="form-control" required></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td><input type="number" name="qty" class="form-control" required></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><input type="text" name="price" id="price" class="form-control" required></td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td><input type="file" name="gambar" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit"></td>
        </tr>
        </table>
        <?php echo form_close(); ?>
        <!-- CONTENTS END -->
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<script type="text/javascript">
    var price = document.getElementById('price');

    price.addEventListener('keyup', function(e) {
        price.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(number, prefix)
    {
    var number_string = number.replace(/[^,\d]/g, '').toString(),
    split    = number_string.split(','),
    sisa     = split[0].length % 3,
    rupiah     = split[0].substr(0, sisa),
    ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
