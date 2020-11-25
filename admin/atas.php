<?php include('cek_session.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>        
  <!-- META SECTION -->
  <title>Aplikasi Pengaduan Jalan Rusak Berbasis GIS</title>            
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
        
  <link rel="icon" href="assets/icon/dbm.png" type="image/x-icon" />
  <!-- END META SECTION -->

  <!-- CSS INCLUDE -->        
  <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
  <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <!-- END CSS INCLUDE -->                                    

  </head>

  <body>
  <!-- START PAGE CONTAINER -->
    <div class="page-container">
      <!-- START PAGE SIDEBAR -->
      <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
          <li class="xn-logo">
            <a href="/"><img style="margin-bottom: 5px;" src="assets/icon/dbm.png" width="20px" height="20px"/> ROAD GIS</a>
            <a href="#" class="x-navigation-control"></a>
          </li>
          <li class="xn-title" style="float: right;padding-top: 10px;font: 15px bold;color: #1caf9a">
            <b>Welcome,<br><?php echo $_SESSION['nama']; ?></b>
          </li>
          <li class="xn-title">Menu Utama</li>
          <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> <span class="xn-text">Beranda</span></a></li> 
          <li><a href="data_pengaduan.php"><span class="glyphicon glyphicon-th-list"></span> <span class="xn-text">Data Pengaduan</span></a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> <span class="xn-text">Keluar</span></a></li>
        </ul>
        <!-- END X-NAVIGATION -->
      </div>
      <!-- END PAGE SIDEBAR -->