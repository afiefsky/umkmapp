<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<?php
function hari_ini($hari){
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;

        case 'Mon':
            $hari_ini = "Senin";
        break;

        case 'Tue':
            $hari_ini = "Selasa";
        break;

        case 'Wed':
            $hari_ini = "Rabu";
        break;

        case 'Thu':
            $hari_ini = "Kamis";
        break;

        case 'Fri':
            $hari_ini = "Jumat";
        break;

        case 'Sat':
            $hari_ini = "Sabtu";
        break;

        default:
            $hari_ini = "Tidak di ketahui";
        break;
    }

    return "<b>" . $hari_ini . "</b>";

}
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Beranda</h1>
        <?php
            if ($message!='') {
                echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    '.$message.'
                </div>';
            } else {

            }
        ?>
        <?php if ($num_rows_companies == 0) { ?>
            Selamat datang di Beranda UMKM-APP! Anda belum memiliki UMKM, buat UMKM anda di <b><?php echo anchor('UMKM/register', 'sini!'); ?></b>
        <?php } else { ?>
            Selamat datang di Beranda UMKM-APP! Kelola UMKM yang sudah anda buat di <b><?php echo anchor('UMKM/manage', 'sini!'); ?></b><br />
            Atau buat UMKM baru anda di <b><?php echo anchor('UMKM/register', 'sini!'); ?>
        <?php } ?>
        <br><br>
        <table class="table table-bordered">
          <tr>
          <?php
          $no = 0;
          $counter = 2;
          foreach ($record->result() as $r) {
            $date = date_create($r->date);
            $day = date_format($date, 'D');
            // echo $no;
              if ($no==$counter) {
                echo "
                <td align='center' width='33.5%'>
                  <u>$r->name</u><br>
                  ".hari_ini($day).", ".date_format($date, 'd-m-Y')."
                  <center>
                  ".anchor('activity/detail/'.$r->id, '<img id="myImg" src='.base_url().'uploads/'.$r->file_name.' width="100" height="100" />')."
                </td></tr><tr>
                ";
                $counter = $counter + 3;
              } else {
                echo "
                <td align='center' width='33.5%'>
                  <u>$r->name</u><br>
                  ".hari_ini($day).", ".date_format($date, 'd-m-Y')."
                  <center>
                  ".anchor('activity/detail/'.$r->id, '<img id="myImg" src='.base_url().'uploads/'.$r->file_name.' width="100" height="100" />')."
                </td>
                ";
              }
              echo '
              ';
              $no++;
          }
          ?>
          </tr>
        </table>
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
