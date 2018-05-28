<?php
	$dbuser = 'root';
	$dbserv = 'localhost';
	$dbname = 'siti_khodijah';
	$dbpass = '';
	$conn = @mysqli_connect($dbserv, $dbuser, $dbpass) or die('Koneksi gagal');
	@mysqli_select_db($conn, $dbname) or die('Database tidak ada');
	if (!isset($_SESSION)) {
		session_start();
	}
	//session_destroy();
?>