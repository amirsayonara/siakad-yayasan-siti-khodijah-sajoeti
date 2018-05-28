<?php
	include 'koneksi.php';
	/*$sql = mysqli_query($conn, "select * from login");
	$hasil= mysqli_fetch_array($sql);*/
	if (!isset($_SESSION['id'])) $_SESSION['id'] = false;
	$id = $_SESSION['id'];
	$sql = mysqli_query($conn, "select * from user where id='$id'");
	$hasil= mysqli_fetch_array($sql);
	if ($hasil<=0) {
		$_SESSION['id'] = false;
		//echo "<script>location.href='?".base64_encrypt('hal=login', $k)."'</script>";
		header('Location: ?'.base64_encrypt('hal=login', $k));
	}
	$id_user = $_SESSION['id'];
	$sql = mysqli_query($conn, "select * from user where id='$id_user'");
	$hasil= mysqli_fetch_array($sql);
	$user=$hasil['user'];
	$nama=$hasil['nama'];
	$akses=$hasil['akses'];
?>