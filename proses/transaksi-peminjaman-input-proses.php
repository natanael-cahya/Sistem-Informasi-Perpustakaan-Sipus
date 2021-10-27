<?php
include'../koneksi.php';
$id_transaksi=$_POST['id_transaksi'];
$id_anggota=$_POST['id_anggota'];
$id_buku=$_POST['id_buku'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$dl = $_POST['deadline'];
$status_anggota="Sedang Meminjam";
$status_buku="Dipinjam";



if(isset($_POST['simpan'])){
	mysqli_query($con,
		"INSERT INTO tbtransaksi
		VALUES('$id_transaksi','$id_anggota','$id_buku','$tgl_pinjam','$dl','','')"
	);
	mysqli_query($con,
		"UPDATE tbanggota
		SET status='$status_anggota'
		WHERE idanggota='$id_anggota'"
	);
	mysqli_query($con,
		"UPDATE tbbuku
		SET status='$status_buku'
		WHERE idbuku='$id_buku'"
	);
	header("location:../index.php?p=transaksi-peminjaman");
}
?>