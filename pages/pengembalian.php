<?php
$params = $_GET['id'];
?>
<div id="label-page"><h3>Pengembalian Buku</h3></div>
<div id="content">
	<form action="proses/transaksi-peminjaman-input-proses.php" method="post">
	<table id="tabel-input">
		<tr>
			<td class="label-formulir">ID Transaksi</td>
			<td class="isian-formulir"><input type="text" name="id_transaksi" class="isian-formulir isian-formulir-border warna-formulir-disabled" value="<?= $params; ?>" readonly="" ></td>
		</tr>
		<tr>
			<td class="label-formulir">Anggota Peminjam</td>
			<td class="isian-formulir">
				
					
					<?php
						$q_tampil_anggota=mysqli_query($con,
							"SELECT * FROM tbtransaksi , tbanggota WHERE tbtransaksi.idanggota = tbanggota.idanggota AND tbtransaksi.idtransaksi = '$params'"
						);
						while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
							?><input type="text" class="isian-formulir isian-formulir-border" value="<?= $r_tampil_anggota['nama'] ?>">
						<?php }
					?>
				
			</td>
		</tr>
		<tr>
			<td class="label-formulir">Buku Yang dipinjam</td>
			<td class="isian-formulir">
				
					<?php
						$q_tampil_buku=mysqli_query($con,
							"SELECT * FROM tbbuku,tbtransaksi WHERE tbtransaksi.idbuku=tbbuku.idbuku AND tbtransaksi.idtransaksi = '$params'"
						);
						while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)){
						?><input type="text" class="isian-formulir isian-formulir-border" value="<?= $r_tampil_buku['judulbuku'] ?>">
						<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Deadline</td>
			<td class="isian-formulir">
				<?php
						$q_tampil=mysqli_query($con,
							"SELECT * FROM tbtransaksi WHERE tbtransaksi.idtransaksi = '$params'"
						);
						while($r_tampil=mysqli_fetch_array($q_tampil)){
						?>
				<input readonly type="text" id="awaal" name="tgl_pinjam" value="<?= $r_tampil['deadline'] ?>"  class="isian-formulir isian-formulir-border  warna-formulir-disabled">
				<?php } ?>	
 			</td>
		</tr>
		<tr>
			<td class="label-formulir">Jumlah Denda</td>
			<td class="isian-formulir">
				<?php
						$q_tampill=mysqli_query($con,
							"SELECT * FROM tbtransaksi WHERE tbtransaksi.idtransaksi = '$params'"
						);
						while($r_tampill=mysqli_fetch_array($q_tampill)){
						?>
				<input readonly type="text" id="awaal" name="tgl_pinjam" value="<?= $r_tampill['denda'] ?>"  class="isian-formulir isian-formulir-border  warna-formulir-disabled">
				<?php } ?>	
			</td>
		</tr>
		<tr>
			<td class="label-formulir"></td>
			<td class="isian-formulir"><a href="proses/pengembalian-proses.php?&id=<?= $params ?>" class="tombol" onclick="confirm('Apakah Sudah membayar denda? jika sudah Silahkan tekan OK!')">Kembalikan Buku</a></td>
		</tr>
	</table>
	</form>
</div>