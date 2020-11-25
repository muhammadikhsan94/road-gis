<?php
	//memanggil file koneksi database
	include('../koneksi.php');	
		
	//tangkap data dari form login
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	//cek data yang dikirim, apakah kosong atau tidak
	if (empty($username) AND empty($password)) {
		//kalau username dan password kosong
		header('location:login.php?error=1');
		return false;
	} else if (empty($username)) {
		//kalau username saja yang kosong
		header('location:login.php?error=2');
		return false;
	} else if (empty($password)) {
		//kalau password saja yang kosong
		//redirect ke halaman index
		header('location:login.php?error=3');
		return false;
	}

	//untuk mencegah sql injection
	//kita gunakan mysql_real_escape_string
	//$username = mysqli_real_escape_string($koneksi, $username);
	//$password = MD5(mysqli_real_escape_string($koneksi, $password));
	
	//mencari data dengan username dan password yang sama di dalam tabel tbl_user
	$q = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'");
	$data_login = mysqli_fetch_array($q);
	//mengecek apakah hasil pencarian data di atas ada
	if (mysqli_num_rows($q) == 1) {
		session_start();
		//kalau username dan password sudah terdaftar di database
		//buat session dengan nama username dengan isi nama user yang login
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data_login['nama_admin'];
		$_SESSION['tipe'] = $data_login['type'];

		//redirect ke halaman index
		header('location:index.php');
	} else {
		//kalau username ataupun password tidak terdaftar di database
		header('location:login.php?error=4');
	}
?>