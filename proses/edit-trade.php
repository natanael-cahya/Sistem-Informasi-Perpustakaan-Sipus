<?php
include"../koneksi.php";
$anggota = $_POST['id_anggota'];
$buku = $_POST['id_buku'];
$tp = $_POST['tgl_pinjam'];
$dl = $_POST['deadline'];

$a = $_POST['aslia'];
$b = $_POST['aslib'];
$id = $_POST['id_transaksi'];

if(isset($_POST['simpan'])){
	if($buku == 0 && $anggota == 0 ){
			mysqli_query($con,"UPDATE tbtransaksi SET idanggota='$a' , idbuku ='$b' , tglpinjam = '$tp' , deadline ='$dl' WHERE idtransaksi = '$id'");
			echo"<script>alert('Data Berhasil diubah');location='../index.php?p=transaksi-peminjaman'</script>";
	}else
	if($anggota == 0){
		mysqli_query($con,"UPDATE tbbuku SET status ='Tersedia' WHERE idbuku = '$b'");
		mysqli_query($con,"UPDATE tbbuku SET status ='Dipinjam' WHERE idbuku = '$buku'");
		mysqli_query($con,"UPDATE tbtransaksi SET idanggota='$a' , idbuku ='$buku' , tglpinjam = '$tp' , deadline ='$dl' WHERE idtransaksi = '$id'");
		
		

		echo"<script>alert('Data Berhasil diubah');location='../index.php?p=transaksi-peminjaman'</script>";
	}else
	if($buku == 0){
		mysqli_query($con,"UPDATE tbtransaksi SET idanggota='$anggota' , idbuku ='$b' , tglpinjam = '$tp' , deadline ='$dl' WHERE idtransaksi = '$id'");
		mysqli_query($con,"UPDATE tbanggota SET status ='Tidak Meminjam' WHERE idanggota = '$a'");
		mysqli_query($con,"UPDATE tbanggota SET status ='Sedang Meminjam' WHERE idanggota = '$anggota'");

		echo"<script>alert('Data Berhasil diubah');location='../index.php?p=transaksi-peminjaman'</script>";
	}
	
}