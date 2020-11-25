<?php 
	session_start();
	//mengecek apakah session username kosong atau tidak
	if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
		//redirect ke halaman login
		header('location:login.php');
	}
?>