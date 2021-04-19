<?php

require 'koneksi.php';

	if (isset($_POST["register"])) {

		if(registrasi($_POST) > 0) {
			echo "<script>
					alert('User baru berhasil ditambahkan!')
					document.location='login.php';
					</script>";
		} else {
			echo mysqli_error($conn);
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" type="text/css" href="style-reg.css">
</head>
<body>
	<div class="regis-box">
		<img src="img/avatar.jpg" class="avatar">
			<form action="" method="post">
				<p>Username</p>
				<input type="text" name="username" id="username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" name="password" id="password" placeholder="Enter Password">
				<p>Konfirmasi Password</p>
				<input type="password" name="password2" id="password2" placeholder="Enter Konfirmasi Password">
				<button type="submit" name="register">Daftar</button>
			</form>
	</div>
</body>
</html>