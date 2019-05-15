<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp. '.number_format($angka, 0, ',', '.');

        return $hasil_rupiah;
    }
?>
<?php
function hari_ini($hari)
{
    switch ($hari) {
        case 'Sun':
            $hari_ini = 'Minggu';
        break;

        case 'Mon':
            $hari_ini = 'Senin';
        break;

        case 'Tue':
            $hari_ini = 'Selasa';
        break;

        case 'Wed':
            $hari_ini = 'Rabu';
        break;

        case 'Thu':
            $hari_ini = 'Kamis';
        break;

        case 'Fri':
            $hari_ini = 'Jumat';
        break;

        case 'Sat':
            $hari_ini = 'Sabtu';
        break;

        default:
            $hari_ini = 'Tidak di ketahui';
        break;
    }

    return '<b>'.$hari_ini.'</b>';
}
?>
        <h2>LAPORAN BARANG KELUAR UMKM <?php echo $this->session->userdata['company_name']; ?></h2>
        <?php
        if ($this->session->userdata('username') == 'admin' || $this->session->userdata('username') == 'superadmin') {
            echo form_open('admin/check_umkm_product');
        } else {
            echo form_open('umkm/manage/product');
        }
        ?>
        <?php echo form_close(); ?>
        <?php
        if ($this->session->userdata('username') == 'admin' || $this->session->userdata('username') == 'superadmin') {
            echo form_open('admin/check_umkm_product');
        } else {
            echo form_open('umkm/manage/product');
        }
        ?>
        <?php echo form_close(); ?>
        <table border="1" width="100%">
          <tr bgcolor="orange">
            <td><b>No</td>
            <td><b>Tgl Keluar</td>
            <td><b>Nama</td>
            <td><b>Qty</td>
            <td><b>Harga</td>
            <td><b>Gambar</td>
          </tr>
          <?php
          $no = 1 + $this->uri->segment(4);
          foreach ($record->result() as $r) {
              if ($this->session->userdata('username') == 'admin') {
                  $edit_button = '';
                  $delete_button = '';
                  $see_button = anchor('shop/product', 'Lihat Produk', ['class' => 'btn btn-primary']);
              } else {
                  $edit_button = anchor('product/edit/'.$r->id, 'Edit', ['class' => 'btn btn-info']);

                  $delete_button = anchor('product/delete/'.$r->id, 'Hapus',
                      [
                          'class'   => 'btn btn-danger',
                          'onclick' => 'return confirm_delete()',
                      ]
                  );
                  $see_button = '';
              }
              echo "<tr>
                <td>$no</td>
                <td>".hari_ini(date_format(date_create($r->created_at), 'D')).', <b>'.date_format(date_create($r->created_at), 'd-m-Y')."</b></td>
                <td>$r->name</td>
                <td>$r->qty</td>
                <td>".rupiah($r->price)."</td>
                <td><a href='".base_url()."uploads/$r->file_name' target='_BLANK'><img src='".base_url()."uploads/$r->file_name' width='50' /></a></td>
              </tr>";
              $no++;
          }
          ?>
        </table>
