<?php
	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "cafe";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//jika tombol simpan di klik
	if (isset($_POST['bsimpan']))
	{
		//Pengujian apakah data akan di edit atau di simpan baru
		if ($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE pesan set
				nama = '$_POST[tnama]',
				jumlah_orang = '$_POST[tjumlah_orang]',
				tanggal = '$_POST[ttanggal]',
				telepon = '$_POST[ttelepon]',
				pesanan = '$_POST[tpesanan]'
				WHERE id_order = '$_GET[id]'");

				if ($edit) //jika edit sukses
				{
					echo "<script>
							alert('Edit Pesanan Sukses!');
							document.location='index.html';
						</script>";
				}
				else
				{
					echo "<script>
							alert('Edit Pesanan Gagal!');
							document.location='index.html';
						</script>";
				}

		} else
		{
			//Data akan di simpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO pesan (nama, jumlah_orang, tanggal, telepon, pesanan)
			VALUES ('$_POST[tnama]', '$_POST[tjumlah_orang]', '$_POST[ttanggal]', '$_POST[ttelepon]', '$_POST[tpesanan]')");

			if ($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan Pesanan Sukses!');
						document.location='index.html';
					</script>";
			}
			else
			{
				echo "<script>
						alert('Simpan Pesanan Gagal!');
						document.location='index.html';
					</script>";
			}
		}

	}

	//Pengujian jika tombol Edit/Hapus di klik
	if (isset($_GET['hal']))
	{
		//Pengujian jika edit data
		if ($_GET['hal'] == "edit")
		{
			//Tampilkan data yang akan di edit
			$tampil = mysqli_query($koneksi, "SELECT * FROM pesan WHERE id_order = '$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if ($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vnama = $data['nama'];
				$vjumlah_orang = $data['jumlah_orang'];
				$vtanggal = $data['tanggal'];
				$vtelepon = $data['telepon'];
				$vpesanan = $data['pesanan'];
			}
		}
		elseif ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM pesan WHERE id_order = '$_GET[id]'");
			if ($hapus)
			{
				echo "<script>
						alert('Hapus Pesanan Sukses!');
						document.location='index.html';
					</script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body background="img/cafe5.jpg">
<div class="container">

	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-dark text-white text text-center">
	    <h2>Form Pemesanan <b>Layya Cafe</b></h2>
	  </div>
	  <div class="card-body bg-light ">
	   <form method="post" action="">
	   		<div class="form-group">
	   		<label>Nama</label>
	   		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" required="">
	   	</div>

	   	<div class="form-group">
	   		<label>Jumlah Orang</label>
	   		<input type="number" name="tjumlah_orang" value="<?=@$vjumlah_orang?>" class="form-control" required="">
	   	</div>

	   	<div class="form-group">
	   		<label>Tanggal</label>
	   		<input type="date" name="ttanggal" value="<?=@$vtanggal?>" class="form-control" required="">
	   	</div>

	   	<div class="form-group">
	   		<label>Nomor Telepon</label>
	   		<input type="text" name="ttelepon" value="<?=@$vtelepon?>" class="form-control" required="">
	   	</div>

	   	<div class="form-group">
	   		<label>Pesanan</label>
	   		<select class="form-control" name="tpesanan">
	   			<option value="<?=@$vpesanan?>"><?=@$vpesanan?></option>
	   			<option value="Bread Basket">Bread Basket</option>
	   			<option value="Honey Almond Granola with Fruits">Honey Almond Granola with Fruits</option>
	   			<option value="Belgian Waffle">Belgian Waffle</option>
	   			<option value="Scrambled Eggs">Scrambled Eggs</option>
	   			<option value="Blueberry Pancakes">Blueberry Pancakes</option>
	   			<option value="Coffee">Coffee</option>
	   			<option value="Chocolato">Chocolato</option>
	   			<option value="Corretto">Corretto</option>
	   			<option value="Iced Tea">Iced Tea</option>
	   			<option value="Soda">Soda</option>
	   		</select>
	   	</div>

	   	<button type="submit" class="btn btn-secondary" name="bsimpan">Order Sekarang!</button>
	   	<button class="btn btn-secondary"><a href="index.html" class="text-white">Kembali</button></a>

	   </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	

</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>