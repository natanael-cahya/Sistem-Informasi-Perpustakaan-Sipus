<?php
session_start();
if(empty($_SESSION['iduser'])){
	header("location:login.php");
}

include'koneksi.php';
$tgl=date('Y-m-d');
?>
<!doctype html>
<html>
<head>
	<title>Sistem Informasi Perpustakaan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
    	dateFormat: 'yy-mm-dd'
    });
  } );
  </script>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="logo-perpustakaan-container">
				<image id="logo-perpustakaan" src="images/n.jpg">
			</div>
			<div id="nama-alamat-perpustakaan-container">
				<div class="nama-alamat-perpustakaan">
					<h1>PERPUSTAKAAN UMUM</h1>
				</div>
				<div class="nama-alamat-perpustakaan">
					<h4>Aplikasi Perpustakaan Berbasis Website</h4>
				</div>
			</div>
		</div>
		<div id="header2">
			<div id="nama-user">Hai, <?= $_SESSION['nama'] ?> &nbsp;&nbsp;<a href="logout.php" class="lg" style="width: 80px;padding-top: 3px;height: 16px;text-align: center;float: right;">Logout</a></div>
		</div>
		<div id="sidebar">
			<a href="index.php?p=beranda">Beranda</a>
			<p class="label-navigasi">Entry Data Dan Transaksi</p>
			<ul>
				<li><a href="index.php?p=user">Data Petugas</a></li>
				<li><a href="index.php?p=anggota">Data Anggota</a></li>
				<li><a href="index.php?p=buku">Data Buku</a></li>
				<li><a href="index.php?p=transaksi-peminjaman">Transaksi Peminjaman</a></li>
			</ul>
			<p class="label-navigasi">Laporan</p>
			<ul>
				<li><a href="cetak/cetak-user.php" target="_blank">Lap.Data Petugas</a></li>
				<li><a href="cetak/cetak-anggota.php" target="_blank">Lap.Data Anggota</a></li>
				<li><a href="cetak/cetak-buku.php" target="_blank">Lap.Data Buku</a></li>
				<li><a href="cetak/cetak-transaksi-peminjaman-pengembalian.php" target="_blank">Lap.Peminjaman dan Pengembalian</a></li>
			</ul>
		</div>
		<div id="content-container">
		<?php
			$pages_dir='pages';
			if(!empty($_GET['p'])){
				$pages=scandir($pages_dir,0);
				unset($pages[0],$pages[1]);
				$p=$_GET['p'];
				if(in_array($p.'.php',$pages)){
					include($pages_dir.'/'.$p.'.php');
				}else{
					echo'Halaman Tidak Ditemukan';
				}
			}else{
				include($pages_dir.'/beranda.php');
			}
		?>
		</div>
		<div id="footer"><h3>Sistem Informasi Perpustakaan &copy;</h3></div>
	</div>
</body>
</html>

<script type="text/javascript">
	function calculate(){
		const awal = document.getElementById("awaal").value;
		var tomorrow = new Date(awal);
		tomorrow.setDate(tomorrow.getDate() + 3);

		document.getElementById("isi").value = tomorrow.toISOString().substring(0,10);
}

</script>