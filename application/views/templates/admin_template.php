<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UMKM Application</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/dist/'; ?>css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url().'assets/dist/'; ?>css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/'; ?>font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/'; ?>http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
  </head>

  <body>
    <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url().'assets/dist/'; ?>index.html">UMKM APP</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li <?php if ($active_page=='dashboard') { echo 'class="active"'; } ?>><?php echo anchor('admin', '<i class="fa fa-dashboard"></i> Beranda');?></li>
            <li <?php if ($active_page=='umkm/manage') { echo 'class="active"'; } ?>><?php echo anchor('admin/umkm', '<i class="fa fa-bar-chart-o"></i> UMKM');?></li>
            <!-- <li><a href="<?php echo base_url().'assets/dist/'; ?>tables.html"><i class="fa fa-table"></i> Tables</a></li>
            <li><a href="<?php echo base_url().'assets/dist/'; ?>forms.html"><i class="fa fa-edit"></i> Forms</a></li>
            <li><a href="<?php echo base_url().'assets/dist/'; ?>typography.html"><i class="fa fa-font"></i> Typography</a></li>
            <li><a href="<?php echo base_url().'assets/dist/'; ?>bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>
            <li><a href="<?php echo base_url().'assets/dist/'; ?>bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>
            <li><a href="<?php echo base_url().'assets/dist/'; ?>blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li> -->
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username'); ?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><?php echo anchor('auth/destroy', '<i class="fa fa-power-off"></i> Log Out');?></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    <?php echo $contents; ?>

    <!-- JavaScript -->
    <script src="<?php echo base_url().'assets/dist/'; ?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url().'assets/dist/'; ?>js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="<?php echo base_url().'assets/dist/'; ?>js/morris/chart-data-morris.js"></script>
    <script src="<?php echo base_url().'assets/dist/'; ?>js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo base_url().'assets/dist/'; ?>js/tablesorter/tables.js"></script>

  </body>
</html>
