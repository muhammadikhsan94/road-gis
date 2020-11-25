<?php 
include "koneksi.php";
include "atas.php";

// MEMANGGIL DATA DALAM DATABASE
$id_lapor  = $_GET['id_lapor'];
$q = mysqli_query($koneksi, " SELECT * FROM tbl_detaillapor
				   INNER JOIN tbl_lapor 
				    ON (tbl_detaillapor.id_lapor = tbl_lapor.id_lapor)
				   INNER JOIN tbl_foto 
				    ON (tbl_foto.id_lapor = tbl_lapor.id_lapor)
				   INNER JOIN tbl_kategori
				   	ON (tbl_kategori.id_kategori = tbl_lapor.id_kategori)
				   WHERE tbl_detaillapor.id_lapor = '$id_lapor' 
				   GROUP BY tbl_lapor.id_lapor");
	
$data = mysqli_fetch_array($q);
?>

<!-- PAGE CONTENT -->
<div class="page-content">
                
	<!-- START BREADCRUMB -->
    <ul class="breadcrumb">
    	<li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="data_pengaduan.php">Data Pengaduan</a></li>
        <li class="active">Informasi Pengaduan</li>
    </ul>
    <!-- END BREADCRUMB -->                       
                
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
    	<div class="row">
        	<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #1caf9a;color: white;">Data Lengkap Pengaduan Jalan Rusak</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Tanggal Lapor:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['tanggal_lapor']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Nama Pelapor:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['nama_pelapor']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Nama Identitas:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['nik']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Alamat:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['alamat']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Nomor HP:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['no_hp']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Nama Jalan Rusak:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['nama_jalan']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Foto Jalan:</b></p>
							</div>
							<div class="col-md-9 bg">
							
							<!-- MEMANGGIL FOTO DALAM TABEL FOTO -->
							<?php
							$o = mysqli_query($koneksi, "SELECT * FROM tbl_foto WHERE id_lapor='$id_lapor'");
							while ($data_foto=mysqli_fetch_array($o)) { ?>
								<div class="col-md-4">
									<img style="width: 100%;height: 150px;margin-bottom: 10px;" class="media-object" src="img/<?php echo $data_foto['foto_jalan']; ?>" alt="Foto Jalan Rusak" title="Foto Jalan Rusak">
								</div>
							<?php } ?>
							<!-- END MEMANGGIL FOTO DALAM TABEL FOTO -->
									        
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Kategori Rusak</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['nama_kategori']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Disposisi:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['disposisi']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Status:</b></p>
							</div>
							<div class="col-md-9 bg">
								<p><b><?php echo $data['status_lapor']; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 bg">
								<p><b>Proses Perbaikan</b></p>
							</div>
							<div class="col-md-5 bg">
								<div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $data['proses_perbaikan']; ?>%;"> <?php echo $data['proses_perbaikan']; ?>% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div> 
</div>

<?php include "bawah.php"; ?>