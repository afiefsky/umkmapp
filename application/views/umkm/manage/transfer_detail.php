<head>
  <style type="text/css">
    /* Style the Image Used to Trigger the Modal */
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 100px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
  </style>
</head>
<?php
    $message = $this->session->flashdata('message');
    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp. '.number_format($angka, 0, ',', '.');

        return $hasil_rupiah;
    }

    function angka($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');

        return $hasil_rupiah;
    }
?>
<h3>Konfirmasi Bukti Transfer Pelanggan</h3>
<?php echo anchor('umkm/manage/transfer_confirmation', 'Kembali', ['class' => 'btn btn-warning']); ?><br><br>
<table class="table table-bordered">
  <tr>
    <td width="20%">Nama Penerima</td>
    <td><input type="text" name="name" class="form-control" placeholder="Atas Nama" value="<?php echo $cart['name'] ?>" readonly></td>
  </tr>
  <tr>
    <td>Alamat Lengkap Penerima</td>
    <td><input type="text" name="address" class="form-control" placeholder="Alamat lengkap penerima" value="<?php echo $cart['address'] ?>" readonly></td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td>
        <input type="email" name="email" class="form-control" placeholder="Email penerima" value="<?php echo $cart['email'] ?>" readonly>
        <h5>* STRUK TRANSAKSI AKAN DIKIRIMKAN MELALUI EMAIL</h5>
    </td>
  </tr>
  <tr>
    <td>Nomor Telpon</td>
    <td><input type="text" name="phone" class="form-control" placeholder="Nomor telpon penerima (call, sms, whatsapp, dll)" value="<?php echo $cart['phone'] ?>" readonly></td>
  </tr>
  <tr>
    <td>Bukti Transfer</td>
    <td>
      <img id="myImg" src="<?php echo base_url().'uploads/'.$cart['file_name']?>" width="300" height="300" />
      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>
    </td>
  </tr>
  <tr>
    <td>

    </td>
    <td>
      <?php echo anchor('umkm/manage/admin_confirmation/'.$cart['id'], 'Konfirmasi', ['class'=>'btn btn-primary', 'onclick'=>'return confirm_question()']); ?>
    </td>
  </tr>
</table>
<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Gambar</th>
    <th>Harga</th>
    <th>Diskon</th>
    <th>Qty</th>
    <th>Sub Total</th>
  </tr>
  <?php
  $no = 1;
  $total = 0;
  foreach ($record->result() as $r) {
      if ($r->is_discount == '1') {
          $count = ($r->price - (($r->price * 15) / 100)) * $r->qty;
          echo "
          <tr>
            <td>$no</td>
            <td><h4><b>$r->name</b></h4></td>
            <td><img src=".base_url().'uploads/'.$r->file_name." width='100' height='100'></td>
            <td>".rupiah($r->price).'</td>
            <td>15%</td>
            <td>'.angka($r->qty).'</td>
            <td>'.rupiah($count).'</td>
          </tr>
          ';
          $no++;
          $total = $total + ($count);
      } else {
          echo "
          <tr>
            <td>$no</td>
            <td><h4><b>$r->name</b></h4></td>
            <td><img src=".base_url().'uploads/'.$r->file_name." width='100' height='100'></td>
            <td>".rupiah($r->price).'</td>
            <td> - </td>
            <td>'.angka($r->qty).'</td>
            <td>'.rupiah($r->price * $r->qty).'</td>
          </tr>
          ';
          $no++;
          $total = $total + ($r->price * $r->qty);
      }
  }
  ?>
  <tr>
    <td colspan="5" align="right"><b>Total :</b></td>
    <td><b><?php echo rupiah($total); ?></b></td>
  </tr>
</table>
<script type="text/javascript">
  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('myImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>
<script type="text/javascript">
function confirm_question() {
  return confirm('APAKAH ANDA YAKIN? PERINTAH TIDAK DAPAT DIBATALKAN!!');
}
</script>
