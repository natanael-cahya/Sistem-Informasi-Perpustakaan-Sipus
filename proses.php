<?php
include"koneksi.php";

if(isset($_POST['login'])){
	session_start();
	$user = $_POST['username'];
	$pw = addslashes($_POST['password']);
	$q = mysqli_query($con,"SELECT * FROM tbuser WHERE username='$user' AND password='$pw'");

	$data = mysqli_fetch_array($q);
	$cek = mysqli_num_rows($q);
	if($cek > 0){
		$_SESSION['iduser'] = $data['iduser'];
		$_SESSION['nama'] = $data['nama'];
		header("location:index.php");
	}else{
		echo"<script>alert('username atau password salah');location='login.php'</script>";
	}
}