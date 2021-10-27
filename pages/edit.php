<?php 
$par = $_GET['id'];
$qu = mysqli_query($con,"SELECT * FROM tbtransaksi WHERE idtransaksi ='$par'");
					$dt = mysqli_fetch_array($qu);
?>


<div id="label-page"><h3>Input Transaksi Peminjaman</h3></div>
<div id="content">
	<form action="proses/edit-trade.php" method="post">
		<input type="hidden" value="<?= $dt['idanggota'] ?>" name="aslia">
<input type="hidden" value="<?= $dt['idbuku'] ?>" name="aslib">
	<table id="tabel-input">
		<tr>
			<td class="label-formulir">ID Transaksi</td>
			<td class="isian-formulir"><input type="text" name="id_transaksi" class="isian-formulir isian-formulir-border warna-formulir-disabled" value="<?= $par ?>" readonly="" ></td>
		</tr>
		<tr>
			<td class="label-formulir">Anggota</td>
			<td class="isian-formulir">
				<select name="id_anggota" class="isian-formulir isian-formulir-border">
					<option value="0" select="selected">~ Pilih Anggota ~</option>
					<?php 
					
					 echo $dt['idtransaksi'];
						$q_tampil_anggota=mysqli_query($con,
							"SELECT * FROM tbanggota WHERE status='Tidak Meminjam'
							ORDER BY idanggota"
						);
						while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){

							?><option value="<?= $r_tampil_anggota['idanggota']?>" > <?= $r_tampil_anggota['idanggota'] ?> | <?= $r_tampil_anggota['nama'] ?></option>
						
						<?php 

					}
					
					?>
				</select>

			</td>
		</tr>
		<tr>
			<td class="label-formulir">Buku</td>
			<td class="isian-formulir">
				<select name="id_buku" class="isian-formulir isian-formulir-border">
					<option value="0" select="selected">~ Pilih Buku ~</option>
					<?php
					
						$q_tampil_buku=mysqli_query($con,
							"SELECT * FROM tbbuku WHERE status='Tersedia'
							ORDER BY idbuku"
						);
						while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)){
							?><option value="<?= $r_tampil_buku['idbuku'] ?>"> <?= $r_tampil_buku['idbuku'] ?> | <?= $r_tampil_buku['judulbuku']?></option>
						<?php }
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Pinjam</td>
			<td class="isian-formulir"><input type="text" id="awaal" onchange="calculate()" name="tgl_pinjam" value="<?= $dt['tglpinjam'] ?>" class="isian-formulir isian-formulir-border datepicker""></td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Deadline</td>
			<td class="isian-formulir"><input type="text"  name="deadline" id="isi" placeholder="Pilih Tanggal Deadline" class="isian-formulir isian-formulir-border datepicker" value="<?= $dt['deadline'] ?>"> <br> *Note: Jika Tanggal Deadline melebihi hari ini biaya Denda Rp.1000/hari</td>
		</tr>
		<tr>
			<td class="label-formulir"></td>
			<td class="isian-formulir"><input type="submit" name="simpan" value="Ubah Data" class="tombol"></td>
		</tr>
	</table>
	</form>
</div>