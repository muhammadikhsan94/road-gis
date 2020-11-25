<!DOCTYPE html>
<head>
	  <title>Login Form!</title>
	  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css"/>
	  <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="col-md-4 col-md-offset-4 form-login">
	<?php
		//ini digunakan untuk mengecek apakah session login username ada
		session_start();
		if (!empty($_SESSION['username'])) {
			//jika ada redirect ke halaman index 
			header('location:index.php');
		}	
	?>
<div class="outter-form-login">
	<div class="logo-login">
		<em class="glyphicon glyphicon-user"></em>
   	</div>
    <form class="form" action="cek_login.php" method="post" action="">
    	<h3 class="text-center title-login">Login Admin</h3>
			<div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username" autofocus>
			</div>
			<div class="form-group">
			<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
                
			<input type="submit" class="btn btn-block btn-custom-green" value="LOGIN" />
			<br>
			<?php 
			//kode php ini kita gunakan untuk menampilkan pesan eror
			if (!empty($_GET['error'])) {
				if ($_GET['error'] == 1) {
					echo '<h4 class="text-center error">Username dan Password belum diisi!</h4>';
				} else if ($_GET['error'] == 2) {
					echo '<h4 class="text-center error">Username belum diisi!</h4>';
				} else if ($_GET['error'] == 3) {
					echo '<h4 class="text-center error">Password belum diisi!</h4>';
				} else if ($_GET['error'] == 4) {
					echo '<h4 class="text-center error">Username dan Password tidak terdaftar!</h4>';
				}
			}
			?>
    </form>
  </div> <!--/ Login-->
</body>
</html>