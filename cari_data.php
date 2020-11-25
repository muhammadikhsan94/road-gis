<?php 
	include "atas.php";
	include "koneksi.php"; 
?>

<!-- PAGE CONTENT -->
<div class="page-content">
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="data_pengaduan.php">Data Pengaduan</li>
        <li class="active">Cari Data Pengaduan</li>
    </ul>
    <!-- END BREADCRUMB -->                       
                
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-lg-12">
            <?php
                $no_urut = 0;
                $search = $_POST['search'];
                $query = "SELECT * FROM tbl_detaillapor
                INNER JOIN tbl_lapor 
                    ON (tbl_detaillapor.id_lapor = tbl_lapor.id_lapor)
                INNER JOIN tbl_foto 
                    ON (tbl_foto.id_lapor = tbl_lapor.id_lapor)
                INNER JOIN tbl_kategori 
                    ON (tbl_lapor.id_kategori = tbl_kategori.id_kategori) 
                WHERE nama_jalan 
                LIKE '%$search%'
                GROUP BY tbl_lapor.id_lapor desc";

                $result = mysqli_query($koneksi, $query);
                while($data = mysqli_fetch_array($result)) {
                    $no_urut++;
            ?>
            
                <!-- LOOPING DATA PENGADUAN -->
                <div style="padding: 10px; border:1px solid #999;" class="media">
                    <div class="media-left media-middle">
                        <a href="#"><img style="width: 120px;height: 120px;" class="media-object" src="img/<?php echo $data['foto_jalan']; ?>" alt="..."></a>
                    </div>
                    <div class="media-body">
                        <p style="font-size: 15px;">
                            <b>Nama Pelapor :</b> <?php echo $data['nama_pelapor']; ?> <br>
                            <b>Tanggal Lapor :</b> <?php echo $data['tanggal_lapor']; ?> <br>
                            <b>Jalan Rusak :</b> <?php echo $data['nama_jalan']; ?> <br>
                            <b>Status Jalan :</b> <?php echo $data['nama_kategori']; ?>
                        </p>
                        <div style="float: left;">
                            <a href="informasi_pengaduan.php?id_lapor=<?php echo $data['id_lapor'];?>" class="btn btn-primary"> Detail <span class="glyphicon glyphicon-new-window"></span></a>
                        </div>
                    </div>
                </div>
                <!-- END LOOPING DATA PENGADUAN -->

            <?php } ?>
            
            </div>
        </div>
    </div>
</div>

<?php include "bawah.php"; ?>