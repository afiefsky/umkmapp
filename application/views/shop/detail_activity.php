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

    return "$hari_ini";

}
?>
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
    $num_rows_companies = $this->session->userdata('num_rows_companies');
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Kegiatan <?php echo $record['name']; ?></h1>
        <?php
          echo anchor($this->session->userdata('active_url'), 'Kembali', ['class' => 'btn btn-warning']) . '<br /><br />';
        ?>
        <?php
        // in case you need a message
        if ($message!='') {
            echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                '.$message.'
            </div>';
        } else {

        }
        ?>
        <table class="table table-bordered">
          <tr>
            <td width="30%" align="center">
              <img id="myImg" src="<?php echo base_url().'uploads/'.$record['file_name'];?>" width="300" height="300">
              <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
              </div>
            </td>
            <td width="70%" align="left">
              <b>Tanggal:</b>
              <?php
                echo hari_ini(date_format(date_create($record['date']), 'D'));
                echo ", ";
                echo date_format(date_create($record['date']), 'd-m-Y');
              ?>
              <br /><br />
              <b>Keterangan:</b><br />
              <?php echo $record['description']; ?>
            </td>
          </tr>
        </table>
        </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
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
function confirm_delete() {
  return confirm('APAKAH ANDA YAKIN? PERINTAH TIDAK DAPAT DIBATALKAN!!');
}
</script>
