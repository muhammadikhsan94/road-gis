<?php
include "../koneksi.php";

$id_lapor = $_POST['id_lapor'];
$disposisi = $_POST['disposisi'];
$status_lapor = $_POST['status_lapor'];
$proses_perbaikan = $_POST['proses_perbaikan'];

if(empty($_POST)) { ?>
	<script type="text/javascript">
		alert("Harap Kolom Diisi");
		document.location.href="/gis/admin/data_pengaduan.php";
	</script>
<?php
} else {
	if ($proses_perbaikan == "100") {
 	$q = mysqli_query($koneksi, "UPDATE tbl_detaillapor SET disposisi='$disposisi',status_lapor='Selesai',proses_perbaikan='$proses_perbaikan' WHERE id_lapor='$id_lapor'");
 } elseif ($proses_perbaikan > "0") {
 	$q = mysqli_query($koneksi, "UPDATE tbl_detaillapor SET disposisi='$disposisi',status_lapor='Proses Perbaikan',proses_perbaikan='$proses_perbaikan' WHERE id_lapor='$id_lapor'");
 } else {
 	$q = mysqli_query($koneksi, "UPDATE tbl_detaillapor SET disposisi='$disposisi',status_lapor='$status_lapor',proses_perbaikan='$proses_perbaikan' WHERE id_lapor='$id_lapor'");
 }
	if($q) { ?>

		<script type="text/javascript">
		alert("Data Tersimpan");
		document.location.href="/gis/admin/informasi_pengaduan.php?id_lapor=<?php echo $id_lapor; ?>";
	</script>
<?php
	} else {
		echo "gagal".mysqli_error();
	}
}

?>