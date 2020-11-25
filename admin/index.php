<?php 
  include "../koneksi.php";
  include('cek_session.php');
?>

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

  <!-- Google Maps API -->
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9cbc9lKYCPmzqQr1HJjhA5o0ASZhLPM&signed_in=true&libraries=places&callback=initMap" async defer></script>
  <!-- End Google Maps API -->

  <!-- CSS INCLUDE -->        
  <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
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

      <!-- PAGE CONTENT -->
      <div class="page-content">
        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
          <li><a href="/"><span class="glyphicon glyphicon-home"></span> Beranda</a></li>
        </ul>
        <!-- END BREADCRUMB -->                       
                
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
          <div class="row">
            <div style="max-width: auto;height: 550px;margin-bottom: 10px;" id="map"></div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <img style='width: 25px; height: 25px' src='assets/icon/ringan.png'/>
              <span style="margin-left: 5px;margin-right: 20px;"><b>JALAN RUSAK RINGAN</b></span> 
              <img style='width: 25px; height: 25px' src='assets/icon/sedang.png'/>
              <span style="margin-left: 5px;margin-right: 20px;"><b>JALAN RUSAK SEDANG</b></span>
              <img style='width: 25px; height: 25px' src='assets/icon/berat.png'/>
              <span style="margin-left: 5px;margin-right: 20px;"><b>JALAN RUSAK BERAT</b></span>
              <img style='width: 25px; height: 25px' src='assets/icon/perbaikan.png'/>
              <span style="margin-left: 5px;margin-right: 20px;"><b>JALAN DALAM PERBAIKAN</b></span>
              <img style='width: 25px; height: 25px' src='assets/icon/selesai.png'/>
              <span style="margin-left: 5px;"><b>JALAN SELESAI DIPERBAIKI</b></span>
            </div>
          </div>
        </div>
        <!-- END CONTENT WRAPPER -->
      </div>
      <!-- END CONTENT -->

    </div>
    <!-- END PAGE CONTAINER -->

    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <script type="text/javascript" src="assets/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/bootstrap/bootstrap.min.js"></script>        
    <!-- END PLUGINS -->

    <!-- START THIS PAGE PLUGINS-->        
    <script type='text/javascript' src='assets/js/plugins/icheck/icheck.min.js'></script>        
    <script type="text/javascript" src="assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
    <script type='text/javascript' src='assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
    <script type='text/javascript' src='assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>   
    <!-- END THIS PAGE PLUGINS-->        

    <!-- START TEMPLATE -->
    <script type="text/javascript" src="assets/js/plugins.js"></script>        
    <script type="text/javascript" src="assets/js/actions.js"></script>
    <script type="text/javascript" src="assets/js/demo_dashboard.js"></script>
    <!-- END TEMPLATE -->

    <!-- Kode Menampilkan Multiple Marker -->
    <script type="text/javascript">
      mapboxgl.accessToken = 'pk.eyJ1IjoibXVoYW1tYWRpa2hzYW45NCIsImEiOiJja2h3dm5lZjEwMG1sMnNvZ25xOXBvdzlpIn0.b8gZzLgBBoZYa0km0EUj1w';
			var map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/streets-v11',
				center: [105.269748, -5.385338],
				zoom: 10
      });
    </script>
    <!-- END SCRIPTS --> 

  </body>
</html>