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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9cbc9lKYCPmzqQr1HJjhA5o0ASZhLPM&signed_in=true&libraries=places&callback=initMap" async defer></script>
  <!-- End Google Maps API -->

  <!-- CSS INCLUDE -->        
  <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
  <!-- END CSS INCLUDE -->                                    
  </head>

  <body onload="peta_awal()">
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
      var peta;
      var nama     = new Array();
      var kategori = new Array();
      var foto     = new Array();
      var x        = new Array();
      var y        = new Array();
      var disposisi = new Array();
      var informasi = new Array();
      var proses   = new Array();
      var status = new Array();
      var i;
      var marker;

      function peta_awal() {
        var kordinat = new google.maps.LatLng(-5.385338, 105.269748);
        // ini buat ngilangin icon place bawaan google maps
        var myStyles =[{
          featureType: "poi",
          elementType: "labels",
          stylers: [
            { visibility: "off" }
          ]
        }];

        var petaoption = {
          zoom: 13,
          center: kordinat,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles: myStyles
        };

        peta = new google.maps.Map(document.getElementById("map"),petaoption);

        // kita bikin dulu array marker dan content info
        var markers = [];
        var info = [];
      
        <?php

        $query = mysql_query("SELECT * FROM tbl_lapor 
                 INNER JOIN tbl_kategori 
                  ON (tbl_lapor.id_kategori = tbl_kategori.id_kategori)
                 INNER JOIN tbl_foto
                  ON (tbl_foto.id_lapor = tbl_lapor.id_lapor)
                 INNER JOIN tbl_detaillapor
                  ON (tbl_detaillapor.id_lapor = tbl_lapor.id_lapor)
                 ORDER BY tbl_lapor.id_lapor");
        $i = 0;
        $js = "";

        // kita lakuin looping datanya disini
        while ($value = mysql_fetch_assoc($query)) {

        $js .= 'nama['.$i.'] = "'.$value['nama_jalan'].'";
                kategori['.$i.']  = "'.$value['nama_kategori'].'";
                x['.$i.'] = "'.$value['lat'].'";
                y['.$i.'] = "'.$value['lng'].'";
                foto['.$i.'] = "'.$value['foto_jalan'].'";
                proses['.$i.'] = "'.$value['proses_perbaikan'].'";
                disposisi['.$i.'] = "'.$value['disposisi'].'";
                informasi['.$i.'] = "'.$value['id_lapor'].'";
                status['.$i.'] = "'.$value['status_lapor'].'";


                if (proses['.$i.'] == "100") {
                set_icon("selesai.png");
              } else if (proses['.$i.'] > "0") {
                set_icon("perbaikan.png");
                } else {
                  set_icon("'.$value['ikon'].'");
                }

                
                // kita set dulu koordinat markernya
                var point = new google.maps.LatLng(parseFloat(x['.$i.']),parseFloat(y['.$i.']));

                // disini kita masukin konten yang akan ditampilkan di InfoWindow
                var contentString = "<b>Nama Jalan = </b>"+nama['.$i.']+"<br>"+
                                    "<b>Kategori Rusak = </b>"+kategori['.$i.']+"<br>"+
                                    "<b>Proses Perbaikan = </b>"+proses['.$i.']+"% ("+disposisi['.$i.']+") <br>"+
                                    "<b>Detail Pengaduan = <a href=informasi_pengaduan.php?id_lapor="+informasi['.$i.']+">LINK</a></b><br>"+
                                    "<img width=550 height=300 src=../img/"+foto['.$i.']+" />";

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 600
                });
                
                tanda = new google.maps.Marker({
                        position: point,
                        map: peta,
                        icon: marker,
                        clickable: true
                    });

                // nah, disini kita buat marker dan infowindow-nya kedalam array
                markers.push(tanda);
                info.push(infowindow);

                // ini fungsi untuk menampilkan konten infowindow kalo markernya diklik
                google.maps.event.addListener(markers['.$i.'], "click", function() {
                    info['.$i.'].open(peta,markers['.$i.']);
                });


                ';
          $i++;  
        }
        // kita tampilin deh output jsnya
        echo $js;
        ?>

      }

      // fungsi inilah yang akan menampilkan gambar ikon sesuai dengan kategori markernya sendiri
      function set_icon(ikon){
          if (ikon == "") {
          } else {
              marker = "assets/icon/"+ikon;
          }
      }

    </script>
    <!-- END SCRIPTS --> 

  </body>
</html>