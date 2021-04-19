<?php

require 'koneksi.php';

	if(isset($_POST["regis"])){
		header("Location: registrasi.php");
	}

	if(isset($_POST["login"])) {

		$username = $_POST["username"];
		$password = $_POST["password"];

		$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

		// cek username
		if(mysqli_num_rows($result) === 1) {

			// cek password
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"])){
				header("Location: admin.html");
				exit;
			}
		}

		$error = true;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="style-log.css">
</head>
<body>
	<div class="login-box">
		<img src="img/avatar.jpg" class="avatar">

			<?php if (isset($error)) : ?>
				<p style="color: red; font-style: italic;">Username / Password salah</p>
			<?php endif; ?>

			<form action="" method="post">
				<p>Username</p>
				<input type="text" name="username" id="username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" name="password" id="password" placeholder="Enter Password">
				<p><button type="submit" name="login">Masuk</button></p>
				<p><button type="submit" name="regis">Daftar</button></p>
			</form>
	</div>
</body>
</html>