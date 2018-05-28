<?php
@$hal = $_GET['hal'];
switch ($hal) {
case 'login':
	/*$sql = mysqli_query($conn, "select * from login");
	$hasil= mysqli_fetch_array($sql);*/
	$hasil = $_SESSION['id'];
	if ($hasil!=false) {
		echo "<script>location.href='.'</script>";
	} session_destroy();session_start();
	?><h1>Login</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=test_login', $k) ?>">
		<center><table>
			<tr>
				<td>Username</td><td><input name="user" required></td>
			</tr><tr>
				<td>Sandi</td><td><input type="password" name="sandi" required></td>
			</tr><tr>
				<td></td><td><button>Masuk</button></td>
			</tr>
		</table></center>
	</form>
	<?php
break;

case 'keluar':
	include "cek_login.php";
	/*mysqli_query($conn, "delete from login");*/
	$_SESSION['id'] = false;
	//echo "<script>location.href='?".base64_encrypt('hal=login', $k)."'</script>";
	header('Location: ?'.base64_encrypt('hal=login', $k));
break;

case 'test_login':
	include 'koneksi.php';
	$user = $_POST['user'];$sandi = md5($_POST['sandi']);
	$sql = mysqli_query($conn, "select * from user where user='$user'");
	$hasil= mysqli_fetch_array($sql);
	if ($hasil > 0) {
		$sql = mysqli_query($conn, "select * from user where user='$user' and sandi='$sandi'");
		$hasil= mysqli_fetch_array($sql);
		if ($hasil > 0) {$id = $hasil['id'];
			/*mysqli_query($conn, "insert into login (id) values ('$id')");*/
			$_SESSION['id'] = $id;
			echo "<script>location.href='.'</script>";
		} else {echo "<script>alert('Kata sandi tidak valid!');location.href='?".base64_encrypt('hal=login', $k)."'</script>";}
	} else {echo "<script>alert('Username tidak terdaftar!');location.href='?".base64_encrypt('hal=login', $k)."'</script>";}
break;

case 'data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	?>
	<h1>Data TK</h1>
	<?php
	$sql = mysqli_query($conn, "select * from data_tk order by nama");
	?>
	<table border="1"><tr>
		<th>No</th><th>Nama</th><th>Status</th><th colspan="2">Pilihan</th>
	</tr>
	<?php $no=1;
	while ($data=mysqli_fetch_array($sql)) {
		?>
		<tr>
			<td><?php echo $no ?></td><td><?php echo $data['nama']?></td><td><?php echo $data['status']?></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=ubah_data_tk&id='.$data['id'], $k) ?>"><button>Ubah</button></form></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=hapus_data_tk&id='.$data['id'], $k) ?>"><button>Hapus</button></form></td>
		</tr>
		<?php $no++;
	}?></table><br><form method="POST" action="?<?php echo base64_encrypt('hal=tambah_data_tk', $k) ?>"><button>Tambah Data</button></form><?php
break;

case 'data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	?>
	<h1>Data Yayasan</h1>
	<?php
	$sql = mysqli_query($conn, "select * from data_yy order by nama");
	?>
	<table border="1"><tr>
		<th>No</th><th>Nama</th><th>Status</th><th colspan="2">Pilihan</th>
	</tr>
	<?php $no=1;
	while ($data=mysqli_fetch_array($sql)) {
		?>
		<tr>
			<td><?php echo $no ?></td><td><?php echo $data['nama']?></td><td><?php echo $data['status']?></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=ubah_data_yy&id='.$data['id'], $k) ?>"><button>Ubah</button></form></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=hapus_data_yy&id='.$data['id'], $k) ?>"><button>Hapus</button></form></td>
		</tr>
		<?php $no++;
	}?></table><br><form method="POST" action="?<?php echo base64_encrypt('hal=tambah_data_yy', $k) ?>"><button>Tambah Data</button></form><?php
break;

case 'manajemen_pengguna':
	include 'cek_login.php';
	?>
	<h1>Manajemen Pengguna</h1>
	<?php
	$sql = mysqli_query($conn, "select * from user order by id");
	if ($akses==0) {
		?>
		<table border="1"><tr>
			<th>No</th><th>Nama Pengguna</th><th>Nama</th><th>Akses</th><th colspan="2">Pilihan</th>
		</tr>
		<?php $no=1;
		while ($data=mysqli_fetch_array($sql)) {
			?>
			<tr>
				<td><?php echo $no ?></td><td><?php echo $data['user']?></td><td><?php echo $data['nama']?></td><td><?php
				$akses_d = $data['akses'];
				if ($akses_d==0) echo 'Administrator';elseif ($akses_d==1) echo 'User TK';else echo 'User KB';?></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=ubah_user&id='.$data['id'], $k) ?>"><button>Ubah</button></form></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=hapus_user&id='.$data['id'], $k) ?>"><button>Hapus</button></form></td>
			</tr>
			<?php $no++;
		}?></table><br><form method="POST" action="?<?php echo base64_encrypt('hal=tambah_user', $k) ?>"><button>Tambah User</button></form><?php
	} else {?>
		<table>
			<tr>
				<td>Nama</td><td>: <?php echo $nama ?></td>
			</tr><tr>
				<td>Nama Pengguna</td><td>: <?php echo $user ?></td>
			</tr><tr>
				<td>Hak Akses</td><td>: <?php if ($akses==1) echo "User TK";else echo "User KB"; ?></td>
			</tr><tr height="20px"></tr><tr>
				<td><form method="POST" action="?<?php echo base64_encrypt('hal=ubah_user&id='.$id_user, $k) ?>"><button>Ubah</button></form></td>
			</tr>
		</table>
	<?php }
break;

case 'update_user':
	include 'cek_login.php';
	@$id = $_GET['id'];$q = mysqli_query($conn, "select * from user where id='$id'");$q = mysqli_fetch_array($q);$idygdiubah=$q['id'];
	$aksesygdiubah=$q['akses'];$namaygdiubah=$q['nama'];$userygdiubah=$q['user'];$nama_baru=$_POST['nama_baru'];$sandi_baru=md5($_POST['sandi_baru']);@$akses_baru=$_POST['akses_baru'];$sandiygdiubah=$q['sandi'];$user_baru=$_POST['user_baru'];
	$sql = mysqli_query($conn, "select * from user order by id");
	$jmladmin=0;while ($data=mysqli_fetch_array($sql)) {
		if ($data['akses']==0) $jmladmin++;
	}
	if ($akses==0 or $id_user==$idygdiubah) {
		if ($akses_baru=='Administrator') $akses_baru=0;elseif ($akses_baru=='User TK') $akses_baru=1;elseif ($akses_baru=='User KB') $akses_baru=2;else $akses_baru=$aksesygdiubah;
	if ($jmladmin<2 and $akses_baru!=0 and $aksesygdiubah==0) {$akses_baru=$aksesygdiubah; echo "<script>alert('Minimal harus terdapat satu Administrator')</script>";}
		if ($sandi_baru=='d41d8cd98f00b204e9800998ecf8427e') $sandi_baru=$sandiygdiubah;
		else echo "<script>alert('Sandi diubah!')</script>";
		if ($hasil > 0) {
			mysqli_query($conn, "update user set user='$user_baru', sandi='$sandi_baru', nama='$nama_baru', akses='$akses_baru' where id=$idygdiubah");
		}
		echo "<script>location.href='?".base64_encrypt('hal=manajemen_pengguna', $k)."'</script>";
	} else "<script>location.href='?".base64_encrypt('hal=manajemen_pengguna', $k)."'</script>";
break;

case 'ubah_user':
	include 'cek_login.php';
	@$id = $_GET['id'];$q = mysqli_query($conn, "select * from user where id='$id'");$q = mysqli_fetch_array($q);$idygdiubah=$q['id'];
	$aksesygdiubah=$q['akses'];$namaygdiubah=$q['nama'];$userygdiubah=$q['user'];
	?><h1>Ubah User</h1><?php
	if ($akses==0 or $id_user==$idygdiubah) {
		?>
		<form action="?<?php echo base64_encrypt('hal=update_user&id='.$idygdiubah, $k) ?>" method="POST">
			<table>
				<tr>
					<td>Nama</td><td><input value="<?php echo $namaygdiubah; ?>" name="nama_baru"></td>
				</tr><tr>
					<td>Nama Pengguna</td><td><input value="<?php echo $userygdiubah; ?>" name="user_baru"></td>
				</tr><tr>
					<td>Sandi</td><td><input type="password" name="sandi_baru"></td>
				</tr><?php if ($akses==0) { ?>
				<tr>
					<td>Akses</td><td><select name="akses_baru"><option>Tidak Diubah</option><?php if ($aksesygdiubah!=0){ ?><option>Administrator</option><?php }if ($aksesygdiubah!=1){ ?><option>User TK</option><?php }if ($aksesygdiubah!=2){ ?><option>User KB</option><?php } ?></select></td>
				</tr>
				<?php } ?>
				<tr>
					<td></td><td><button>Ubah</button></td>
				</tr>
			</table>
		</form>
		<?php
	} else {
		"<script>location.href='?".base64_encrypt('hal=manajemen_pengguna', $k)."'</script>";
	}
break;

case 'hapus_user':
	include 'cek_login.php';
	$id = $_GET['id'];
	if ($hasil > 0 and $akses==0 and $id_user!=$id) {
		mysqli_query($conn, "delete from user where id='$id'");
	} if ($id_user==$id) echo "<script>alert('Tidak dapat menghapus Anda sendiri')</script>";
	echo "<script>location.href='?".base64_encrypt('hal=manajemen_pengguna', $k)."'</script>";
break;

case 'simpan_user':
	include 'cek_login.php';
	@$user_in = $_POST['user_in'];
	@$nama_in = $_POST['nama_in'];
	@$sandi_in= md5($_POST['sandi_in']);
	@$akses_in= $_POST['akses_in'];
	if ($akses_in=='Admnistrator') $akses_in = 0;
	if ($akses_in=='User TK') $akses_in = 1;
	if ($akses_in=='User KB') $akses_in = 2;
	$ne = mysqli_query($conn, "select * from user");
	if ($hasil > 0 and $akses==0 and $user_in!='' and $sandi_in!='d41d8cd98f00b204e9800998ecf8427e') {
		$dup = 0;
		while ($re = mysqli_fetch_array($ne)) {
			if ($re['user'] == $user_in) {
				echo "<script>alert('Nama Pengguna sudah ada!');location.href='?".base64_encrypt('hal=tambah_user', $k)."';</script>";
				$dup = 1;
			}
		}
		if ($dup != 1) mysqli_query($conn, "insert into user (user, sandi, nama, akses) values ('$user_in', '$sandi_in', '$nama_in', '$akses_in')");
	} echo "<script>location.href='?".base64_encrypt('hal=manajemen_pengguna', $k)."'</script>";
break;

case 'tambah_user':
	include 'cek_login.php';
	?><h1>Tambah User</h1><?php
	if ($akses==0) {
		?>
		<form action="?<?php echo base64_encrypt('hal=simpan_user', $k) ?>" method="POST">
			<table>
				<tr>
					<td>Nama</td><td><input name="nama_in"></td>
				</tr><tr>
					<td>Nama Pengguna</td><td><input name="user_in"></td>
				</tr><tr>
					<td>Sandi</td><td><input type="password" name="sandi_in"></td>
				</tr><?php if ($akses==0) { ?>
				<tr>
					<td>Akses</td><td><select name="akses_in"><option>Administrator</option><option>User TK</option><option>User KB</option></select></td>
				</tr>
				<?php } ?>
				<tr>
					<td></td><td><button>Tambah</button></td>
				</tr>
			</table>
		</form>
		<?php
	} else {
		echo "<script>location.href='?".base64_encrypt('hal=manajemen_pengguna')."'</script>";
	}
break;

case 'data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	?>
	<h1>Data KB</h1>
	<?php
	$sql = mysqli_query($conn, "select * from data_kb order by nama");
	?>
	<table border="1"><tr>
		<th>No</th><th>Nama</th><th>Status</th><th colspan="2">Pilihan</th>
	</tr>
	<?php $no=1;
	while ($data=mysqli_fetch_array($sql)) {
		?>
		<tr>
			<td><?php echo $no ?></td><td><?php echo $data['nama']?></td><td><?php echo $data['status']?></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=ubah_data_kb&id='.$data['id'], $k) ?>"><button>Ubah</button></form></td><td><form method="POST" action="?<?php echo base64_encrypt('hal=hapus_data_kb&id='.$data['id'], $k) ?>"><button>Hapus</button></form></td>
		</tr>
		<?php $no++;
	}?></table><br><form method="POST" action="?<?php echo base64_encrypt('hal=tambah_data_kb', $k) ?>"><button>Tambah Data</button></form><?php
break;

case 'hapus_data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];
	mysqli_query($conn, "delete from data_yy where id='$id'");
	echo "<script>location.href='?".base64_encrypt('hal=data_yy', $k)."'</script>";
break;

case 'hapus_data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];
	mysqli_query($conn, "delete from data_tk where id='$id'");
	echo "<script>location.href='?".base64_encrypt('hal=data_tk', $k)."'</script>";
break;

case 'hapus_data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];
	mysqli_query($conn, "delete from data_kb where id='$id'");
	echo "<script>location.href='?".base64_encrypt('hal=data_kb', $k)."'</script>";
break;

case 'ubah_data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];$sql = mysqli_query($conn, "select * from data_yy where id='$id'");$data = mysqli_fetch_array($sql);
	?><h1>Ubah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=update_data_yy&id='.$id, $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama" value="<?php echo $data['nama'] ?>"></td>
			</tr><tr>
				<td>Status</td><td><input name="status" value="<?php echo $data['status'] ?>"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'ubah_data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];$sql = mysqli_query($conn, "select * from data_tk where id='$id'");$data = mysqli_fetch_array($sql);
	?><h1>Ubah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=update_data_tk&id='.$id, $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama" value="<?php echo $data['nama'] ?>"></td>
			</tr><tr>
				<td>Status</td><td><input name="status" value="<?php echo $data['status'] ?>"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'ubah_data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];$sql = mysqli_query($conn, "select * from data_kb where id='$id'");$data = mysqli_fetch_array($sql);
	?><h1>Ubah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=update_data_kb&id='.$id, $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama" value="<?php echo $data['nama'] ?>"></td>
			</tr><tr>
				<td>Status</td><td><input name="status" value="<?php echo $data['status'] ?>"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'tambah_data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	?><h1>Tambah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=simpan_data_yy', $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama"></td>
			</tr><tr>
				<td>Status</td><td><input name="status"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'tambah_data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	?><h1>Tambah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=simpan_data_kb', $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama"></td>
			</tr><tr>
				<td>Status</td><td><input name="status"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'tambah_data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	?><h1>Tambah Data</h1>
	<form method="POST" action="?<?php echo base64_encrypt('hal=simpan_data_tk', $k) ?>">
		<table>
			<tr>
				<td>Nama</td><td><input name="nama"></td>
			</tr><tr>
				<td>Status</td><td><input name="status"></td>
			</tr><tr>
				<td></td><td><button>Simpan</button></td>
			</tr>
		</table>
	</form>
	<?php
break;

case 'simpan_data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	$nama = $_POST['nama'];$status = $_POST['status'];
	if (!($nama=="" & $status==""))
		mysqli_query($conn, "insert into data_yy (nama, status) values ('$nama', '$status')");
	echo "<script>location.href='?".base64_encrypt('hal=data_yy', $k)."'</script>";
break;

case 'simpan_data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	$nama = $_POST['nama'];$status = $_POST['status'];
	if (!($nama=="" & $status==""))
		mysqli_query($conn, "insert into data_kb (nama, status) values ('$nama', '$status')");
	echo "<script>location.href='?".base64_encrypt('hal=data_kb', $k)."'</script>";
break;

case 'simpan_data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	$nama = $_POST['nama'];$status = $_POST['status'];
	if (!($nama=="" & $status==""))
		mysqli_query($conn, "insert into data_tk (nama, status) values ('$nama', '$status')");
	echo "<script>location.href='?".base64_encrypt('hal=data_tk', $k)."'</script>";
break;

case 'update_data_yy':
	include 'cek_login.php';
	if ($akses!=0) echo "<script>location.href='.'</script>";
	$id = $_GET['id'];$nama=$_POST['nama'];$status=$_POST['status'];
	mysqli_query($conn, "update data_yy set nama='$nama', status='$status' where id=$id");
	echo "<script>location.href='?".base64_encrypt('hal=data_yy', $k)."'</script>";
break;

case 'update_data_tk':
	include 'cek_login.php';
	if ($akses==2) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];$nama=$_POST['nama'];$status=$_POST['status'];
	mysqli_query($conn, "update data_tk set nama='$nama', status='$status' where id=$id");
	echo "<script>location.href='?".base64_encrypt('hal=data_tk', $k)."'</script>";
break;

case 'update_data_kb':
	include 'cek_login.php';
	if ($akses==1) echo "<script>location.href='.'</script>";
	@$id = $_GET['id'];$nama=$_POST['nama'];$status=$_POST['status'];
	mysqli_query($conn, "update data_kb set nama='$nama', status='$status' where id=$id");
	echo "<script>location.href='?".base64_encrypt('hal=data_kb', $k)."'</script>";
break;

default:
	include "cek_login.php";
	if ($_SERVER['REQUEST_URI']=='/')
		echo "Selamat datang di Halaman Utama Portal";
	else {
		echo "<span style='color:red'>URL tidak valid atau sudah kadaluarsa!<br><br>PERHATIAN:<br>Jangan memuat ulang laman atau memasukkan URL yang pernah ada sebelumnya. Demi keamanan, silahkan muat ulang laman untuk melakukan log in kembali.</span>";
		$_SESSION['id']=false;
	}
break;
}
?>