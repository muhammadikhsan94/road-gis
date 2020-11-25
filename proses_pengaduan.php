<?php
include "koneksi.php";

$tanggal_lapor = $_POST['tanggal_lapor'];
$nama_pelapor = $_POST['nama_pelapor'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$nama_jalan = $_POST['nama_jalan'];
$id_kategori = $_POST['id_kategori'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
				
//MENGHITUNG JUMLAH FOTO//
$count = count($_FILES['foto_jalan']["name"]);

if(empty($_POST)) { ?>
	<script type="text/javascript">
		alert("Harap Kolom Diisi");
		document.location.href="data_pengaduan.php";
	</script>
<?php
} else {
	// Masukkan Data kedalam Tabel Lapor
	$q = mysqli_query($koneksi, "INSERT INTO tbl_lapor (tanggal_lapor,nama_pelapor,nik,alamat,no_hp,nama_jalan,id_kategori,lat,lng) 
	 	VALUES ('$tanggal_lapor','$nama_pelapor','$nik','$alamat','$no_hp','$nama_jalan','$id_kategori','$lat','$lng')");

	for ($i=0; $i < $count ; $i++) { 
		// Menyimpan Data Foto Kedalam Folder Img/
		$temp = explode(".", $_FILES["foto_jalan"]["name"][$i]);
		$newfilename = round(microtime(true)) .$i. '.' . end($temp);
		move_uploaded_file($_FILES['foto_jalan']['tmp_name'][$i], "img/".$newfilename);

		$qx = mysqli_query($koneksi, "INSERT INTO tbl_foto (id_lapor,foto_jalan) 
	 	VALUES (LAST_INSERT_ID(),'$newfilename')");

	}

	if($qx) {?>
		<script type="text/javascript">
		alert("Data Tersimpan");
		document.location.href="data_pengaduan.php";
	</script>
<?php
	} else {
		echo "gagal".mysqli_error();
	}
}

// Membuat Set Default Data kedalam Tabel Detail Lapor
 	$p = mysqli_query($koneksi, "INSERT INTO tbl_detaillapor (id_lapor,disposisi,status_lapor,proses_perbaikan) VALUES (LAST_INSERT_ID(),'Belum Ditentukan','Diterima','0')");
	mysqli_fetch_array('$p');
	
?>