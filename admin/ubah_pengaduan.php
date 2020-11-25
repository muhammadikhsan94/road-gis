<?php
	include "atas.php";
	include "../koneksi.php";

	$id  = $_GET['id_lapor'];
	$q    = mysqli_query($koneksi, "SELECT * FROM tbl_detaillapor where id_lapor='$id'");
	$data = mysqli_fetch_array($q);
?>

<!-- PAGE CONTENT -->
<div class="page-content">
                
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
		<li><a href="data_pengaduan.php">Data Pengaduan</a></li>
		<li><a href="data_pengaduan.php">Informasi Pengaduan</a></li>
		<li class="active">Ubah Informasi Pengaduan</li>
	</ul>
	<!-- END BREADCRUMB -->                       
                
	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #1caf9a;color: white;">Ubah Data Pengaduan Jalan Rusak</div>
					<div class="panel-body">
						<form role="form" action="proses_ubah_pengaduan.php" name="form1" method="post">
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>ID Lapor:</b></p>
								</div>
								<div class="col-md-1 bg">
									<input class='form-control' name='id_lapor' value='<?php echo $data['id_lapor']; ?>' readonly=''></b>
								</div>
							</div><br>

							<!-- SESSION TIPE 1 -->
							<?php if($_SESSION['tipe'] == 1) { 
							// Kondisi Jika Disposisi Belum Ditentukan Maka Status Lapor tidak dapat dipilih
							if ($data['disposisi'] == "Belum Ditentukan") { ?>

							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Disposisi:</b></p>
								</div>
								<div class="col-md-4 bg">
									<select name="disposisi" class="form-control">
										<option value="Belum Ditentukan">Belum Ditentukan</option>
										<option value="Dinas Bina Marga Kota Bandar Lampung">Dinas Bina Marga Kota Bandar Lampung</option>
										<option value="Dinas Bina Marga Provinsi Lampung">Dinas Bina Marga Provinsi Lampung</option>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Status Lapor:</b></p>
								</div>
								<div class="col-md-4 bg">
									<input class="form-control" name="status_lapor" value="<?php echo $data['status_lapor']; ?>" readonly="">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Proses Perbaikan</b></p>
								</div>
								<div class="col-md-1 bg">
									<input class="form-control" name="proses_perbaikan" value="<?php echo $data['proses_perbaikan']; ?>" readonly="">
								</div>
							</div>
							
							<?php } else { ?>
							<!-- Kondisi Jika Disposisi Sudah Ditentukan Maka Status Lapor dapat dipilih -->
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Disposisi:</b></p>
								</div>
								<div class="col-md-4 bg">
									<input class="form-control" name="disposisi" value="<?php echo $data['disposisi']; ?>" readonly="">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Status Lapor:</b></p>
								</div>
								<div class="col-md-4 bg">
									<select name="status_lapor" class="form-control">
										<option value="Diterima">Diterima</option>
										<option value="Survey">Survey</option>
										<option value="Proses Perbaikan" disabled>Proses Perbaikan</option>
										<option value="Selesai" disabled>Selesai</option>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Proses Perbaikan</b></p>
								</div>
								<div class="col-md-1 bg">
									<input class="form-control" name="proses_perbaikan" value="<?php echo $data['proses_perbaikan']; ?>" readonly="">
								</div>
							</div>

							<?php } ?>

							<!-- Session Tipe 1 -->
							<!-- Hanya dapat Mengubah Proses Perbaikan -->
							<?php } elseif ($_SESSION['tipe'] == 2) {  ?>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Disposisi:</b></p>
								</div>
								<div class="col-md-4 bg">
									<input class="form-control" name="disposisi" value="<?php echo $data['disposisi']; ?>" readonly="">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Status Lapor:</b></p>
								</div>
								<div class="col-md-4 bg">
									<input class="form-control" name="status_lapor" value="<?php echo $data['status_lapor']; ?>" readonly="">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3 bg">
									<p><b>Proses Perbaikan</b></p>
								</div>
								<div class="col-md-9 bg">
									<div class="row">
										<div class="col-xs-5">
											<div id="slider" style="margin-left: -3px;margin-top: 5px;"></div>
										</div>
										<div class="col-xs-1">
											<input class="form-control" id="data-1" name="proses_perbaikan" value="<?php echo $data['proses_perbaikan']; ?>" style="margin-top: -5px;">
										</div>
									</div>
								</div>
							</div>

							<?php } ?>

							<br>
							<div class="row">
								<div style="margin-left: 280px">
									<input type="submit" class="btn btn-primary" value="Update" />
									<input type="reset" class="btn btn-primary" value="Batal" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Javascript -->
      <script>
         $('#slider').slider({
    		slide:function(event, ui) {
        		$('#data-1').val(ui.value);
    		}
		});
      </script>

<?php include "bawah.php"; ?>