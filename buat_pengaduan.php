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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl9cbc9lKYCPmzqQr1HJjhA5o0ASZhLPM&libraries=places&callback=initMap" async defer></script>
    <!-- End Google Maps API -->

    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
    <!-- END CSS INCLUDE -->  

    <!-- DATE TIME -->
    <?php
        date_default_timezone_set('Asia/Jakarta');
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    ?>  
    <!-- END DATE TIME -->
    
    <script type="text/javascript">
        function stopRKey(evt) {
          var evt = (evt) ? evt : ((event) ? event : null);
          var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
          if ((evt.keyCode == 13) && ((node.type=="text") || (node.type=="radio") || (node.type=="checkbox")) )  {return false;}
        }

        document.onkeypress = stopRKey;
</script> 

    </head>

    <body onload="initMap()">
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
                <li class="xn-title">Menu Utama</li>
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> <span class="xn-text">Halaman Utama</span></a></li> 
                <li><a href="buat_pengaduan.php"><span class="glyphicon glyphicon-plus"></span> <span class="xn-text">Buat Pengaduan</span></a></li>
                <li><a href="data_pengaduan.php"><span class="glyphicon glyphicon-th-list"></span> <span class="xn-text">Data Pengaduan</span></a></li>
            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">
            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>                    
                <li class="active">Buat Pengaduan</li>
            </ul>
            <!-- END BREADCRUMB -->                       
                
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: #1caf9a;color: white;">Buat Pengaduan</div>
                            <div class="panel-body">
                                <form id="form-input" class="form-horizontal" role="form" action="proses_pengaduan.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-3">Tanggal Lapor</label>
                                        <div class="col-md-4">
                                        <input class="form-control" placeholder="Tanggal Lapor " name="tanggal_lapor" type="text" value="<?php echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y"); ?>" readonly="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Nama Pelapor</label>
                                        <div class="col-md-4">
                                        <input class="form-control" placeholder="Nama Lengkap " name="nama_pelapor" type="text" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Nomor Identitas</label>
                                        <div class="col-md-4">
                                        <input class="form-control" placeholder="NIK " name="nik" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Alamat Pelapor</label>
                                        <div class="col-md-9">
                                        <input class="form-control" placeholder="Alamat Anda " name="alamat" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Nomor HP</label>
                                        <div class="col-md-4">
                                        <input class="form-control" placeholder="Nomor HP " name="no_hp" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Nama Jalan Rusak</label>
                                        <div class="col-md-9">
                                        <input class="form-control" placeholder="Nama Jalan " id="nama_jalan" name="nama_jalan" type="text"  onchange="geocodeLokasi()">
                                        <i>* Contoh : Jalan Bumi Manti 1 Kampung Baru Bandar Lampung</i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Kordinat</label>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="Latitude " id="lat" name="lat" type="text" readonly="">
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="Longitude " id="lng" name="lng" type="text" readonly="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Kategori Rusak</label>
                                        <div class="col-md-3">
                                        <select name="id_kategori" class="form-control">
                                            <option value="#">Pilih Kategori Rusak</option>
                                            <option value="1">Jalan Rusak Ringan</option>
                                            <option value="2">Jalan Rusak Sedang</option>
                                            <option value="3">Jalan Rusak Berat</option>
                                        </select>
                                        </div>
                                        <a href="#" data-toggle="modal" data-target="#ket"><span class="glyphicon glyphicon-question-sign" style="margin-top:5px;font-size:18px;"></span></a>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Foto Jalan</label>
                                        <div class="col-md-9">
                                        <input class="form-control" name="foto_jalan[]" type="file" multiple="" accept="images/*">
                                        </div>
                                    </div>

                                    <div class="col-md-offset-3">
                                    <button id="btn-input" type="submit" class="btn btn-primary">KIRIM</button>
                                    <button type="reset" class="btn btn-default">BATALKAN</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="panel panel-default">
                                  <div class="panel-heading" style="background-color: #1caf9a;color: white;">Peta</div>
                                  <div class="panel-body">
                                    <div style="width: auto;height: 300px;" id="map"></div>
                                    <p style="margin-top: 5px;text-align: center;color: red"><b>* Tarik Titik Marker Jika Kordinat Tidak Sesuai *</b></p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>        
            </div>
            <!-- END PAGE CONTENT WRAPPER -->                                
        </div>            
        <!-- END PAGE CONTENT -->

    </div>
    <!-- END PAGE CONTAINER -->

    <!-- Modal -->
    <div id="ket" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">KATEGORI RUSAK</h4>
          </div>
          <div class="modal-body">
            <p><b>Ringan:</b> Jalan berlubang/retak/bergelombang sedalam 1-5cm sepanjang 1-2 meter.</p>
            <p><b>Sedang:</b> Jalan berlubang/retak/bergelombang sedalam 5-10cm sepanjang 3-4 meter</p>
            <p><b>Berat:</b> Jalan berlubang/retak/bergelombang sedalam >10cm sepanjang >5 meter.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- End Modal content-->

      </div>
    </div>
    <!-- End Modal -->

    <!-- START SCRIPTS -->

    <!-- GEOCODER AUTOCOMPLETE MAPS -->
    <script src="assets/js/lokasi.js"></script>
    <!-- END GEOCODER AUTOCOMPLETE MAPS -->

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

    <!-- END SCRIPTS -->         
    
    </body>
</html>