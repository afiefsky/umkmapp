<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3>Tambah Produk Ke Keranjang</h3>
<h4><?php echo $message; ?></h4>
<h5>* MOHON INPUTKAN KUANTITAS PRODUK YANG ANDA BELI</h5>
<?php echo anchor('shop_umkm/product', 'Kembali', ['class' => 'btn btn-warning']); ?><br><br>
<?php echo form_open('shop_umkm/add_to_cart/'.$this->uri->segment(3)); ?>
<table class="table table-bordered">
  <tr>
    <th>Nama</th>
    <th>Gambar</th>
    <td>Harga</td>
    <td>Stok Tersedia</td>
    <th>Qty</th>
    <th>Opsi</th>
  </tr>
  <tr>
    <td><h4><b><?php echo $record['name'] ?></b></h4></td>
    <td><img src="<?php echo base_url().'uploads/'.$record['file_name'] ?>" width="100" height="100"></td>
    <td><?php echo rupiah($record['price']); ?></td>
    <td><?php echo $record['qty']; ?></td>
    <td width="10%"><input type="number" name="qty" value="1" required></td>
    <td><input type="submit" name="submit" class="btn btn-primary"></td>
  </tr>
</table>
<?php echo form_close(); ?>
