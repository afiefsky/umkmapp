<?php
    $message = $this->session->flashdata('message');
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<h1>Beranda</h1>
<?php
    if ($message != '') {
        echo '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            '.$message.'
        </div>';
    } else {
    }
?>
Selamat datang di halaman admin UMKM APP, silahkan pilih menu di samping untuk mulai menggunakan aplikasi
