<?php 
    include "atas.php";
    include "../koneksi.php"; 
?>

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Data Pengaduan</li>
        </ul>
        
        <!-- END BREADCRUMB -->                       
                
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">

            <!-- FORM PENCARIAN DATA -->
            <div class="row">
                <form method="post" action="cari_data.php">
                    <div class="row">
                        <div style="float: right;margin-right: 50px;margin-bottom: 10px;">
                            <div class="col-md-10">
                                <input type="text" name="search" placeholder="Cari Data Berdasarkan Nama Jalan" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="search" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END FORM PENCARIAN DATA -->
            
            <div class="col-lg-12">
            <?php
                // Pagination
                $batas = 3;
                $halaman = @$_GET['halaman'];
                if(empty($halaman)){
                    $posisi = 0;
                    $halaman = 1;
                } else {
                    $posisi = ($halaman - 1) * $batas;
                }

                $q = mysqli_query($koneksi, "SELECT * FROM tbl_detaillapor
                     INNER JOIN tbl_lapor 
                      ON (tbl_detaillapor.id_lapor = tbl_lapor.id_lapor)
                     INNER JOIN tbl_foto 
                      ON (tbl_foto.id_lapor = tbl_lapor.id_lapor)
                     INNER JOIN tbl_kategori 
                      ON (tbl_lapor.id_kategori = tbl_kategori.id_kategori) 
                     GROUP BY tbl_lapor.id_lapor desc 
                     LIMIT $posisi,$batas");

                while ($data = mysqli_fetch_array($q)) { ?>
                
                <!-- LOOPING DATA LAPOR MENURUT ID LAPOR -->
                <div style="padding: 10px; border:1px solid #999;" class="media">
                    <div class="media-left media-middle">
                        <a href="#"><img style="width: 120px;height: 120px;" class="media-object" src="../img/<?php echo $data['foto_jalan']; ?>" alt="..."></a>
                    </div>
                    <div class="media-body">
                        <p style="font-size: 15px;">
                            <b>Nama Pelapor :</b> <?php echo $data['nama_pelapor']; ?> <br>
                            <b>Tanggal Lapor :</b> <?php echo $data['tanggal_lapor']; ?> <br>
                            <b>Jalan Rusak :</b> <?php echo $data['nama_jalan']; ?> <br>
                            <b>Kategori Rusak :</b> <?php echo $data['nama_kategori']; ?>
                        </p>
                        <div style="float: left;">
                            <a href="informasi_pengaduan.php?id_lapor=<?php echo $data['id_lapor'];?>" class="btn btn-primary"> Detail <span class="glyphicon glyphicon-new-window"></span></a>
                        </div>
                    </div>
                </div>
                <!-- END LOOPING DATA LAPOR MENURUT ID LAPOR -->

                <?php } 
                
                // Hitung Total data dan halaman serta link 1,2,3..
                $paging2 = mysqli_query($koneksi, "select * from tbl_lapor");
                $jmldata = mysqli_num_rows($paging2);
                $jmlhalaman = ceil($jmldata/$batas);
                            
                echo "<div style='float: right;'>";
                echo "<br> <span>Halaman : </span>";
                for($i=1; $i<=$jmlhalaman; $i++) {
                    if($i != $jmlhalaman) {
                        echo "<a style='border: 1px solid #fff;' class='btn btn-primary' href='data_pengaduan.php?halaman=$i'>$i</a>";
                    }
                }
                echo "</div>";
                                ?>
            </div>   
        </div>
    </div>

<?php include "bawah.php"; ?>