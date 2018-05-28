<?php
include 'koneksi.php';
include 'fungsi.php';
//pengambilan dan penetapan kode
$kunci_utama = 'bz27BuXDV';
$ks = @base64_decrypt($_COOKIE['pXh8U'], $kunci_utama);
$k = random_karakter();
setcookie('pXh8U', base64_encrypt($k, $kunci_utama));
if ($ks==false) echo "<script>location.href='.'</script>";
//echo base64_decrypt(@explode('?',$_SERVER['REQUEST_URI'])[1], $ks).'<br>';
$_GET = extract_var(base64_decrypt(@explode('?',$_SERVER['REQUEST_URI'])[1], $ks));
	/*$sql = mysqli_query($conn, "select * from login");*/
	/*$hasil= mysqli_fetch_array($sql);*/
	if (!isset($_SESSION['id'])) $_SESSION['id'] = false;
	$hasil = $_SESSION['id'];
	if ($hasil==false) {
		echo "Belum masuk";
	} else {
		$id_user = $_SESSION['id'];$sql = mysqli_query($conn, "select * from user where id='$id_user'");$hasil= mysqli_fetch_array($sql);$user=$hasil['user'];$nama=$hasil['nama'];$akses=$hasil['akses'];
		if ($akses==0) $hak = 'Administrator';elseif ($akses==1) $hak = 'User TK';else $hak='User KB';
		?><hr>
		Nama User:<br>
		<?php echo $nama ?><hr>
		Hak Akses:<br>
		<?php echo $hak ?><hr><hr>
		<center>Menu</center><hr>
		<a onclick="location.href='/'">Halaman Awal</a><hr>
		<?php
		if ($akses==0) {
			?>
			<a onclick="location.href='?<?php echo base64_encrypt('hal=data_yy', $k) ?>'">Data Yayasan</a><hr>
			<?php
		} if ($akses==1 or $akses==0) {
			?>
			<a onclick="location.href='?<?php echo base64_encrypt('hal=data_tk', $k) ?>'">Data TK</a><hr>
			<?php
		} if ($akses==2 or $akses==0) {
			?>
			<a onclick="location.href='?<?php echo base64_encrypt('hal=data_kb', $k) ?>'">Data KB</a><hr>
			<?php
		}?>
		<a onclick="location.href='?<?php echo base64_encrypt('hal=manajemen_pengguna', $k) ?>'">Manajemen Pengguna</a><hr>
		<a onclick="location.href='?<?php echo base64_encrypt('hal=keluar', $k) ?>'">Keluar</a><hr>
<?php } ?>