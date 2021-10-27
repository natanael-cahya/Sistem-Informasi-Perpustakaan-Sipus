<?php
date_default_timezone_set('Asia/Jakarta');
$qq = mysqli_query($con,"select * from tbtransaksi");
while($r=mysqli_fetch_array($qq)){
$tgll = date('Y-m-d'); 
$tgl1 = strtotime($tgll);
$tgl2 = strtotime($r['deadline']); 

$jarak = $tgl2 - $tgl1;

$hari = $jarak / 60 / 60 / 24;

//$l=ltrim($hari,'-');
if($hari < 0){
	$tt = $r['idtransaksi'];
	$d = $hari * 1000;
	$l = ltrim($d,'-');
	//echo $l.'<br>';
	mysqli_query($con,"UPDATE tbtransaksi SET denda='$l' WHERE idtransaksi='$tt'");
}
}
?>
<div id="label-page"><h3>Transaksi Peminjaman</h3></div>
<div id="content">
	<p id="tombol-tambah-container"><a href="index.php?p=transaksi-peminjaman-input" class="tombol">Transaksi Baru</a></p>
	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</td>
			
			<th>ID Anggota</th>
			<th>Nama</th>
			<th>ID Buku</th>
			<th>Judul Buku</th>
			<th>Tanggal Pinjam</th>
			<th>Deadline</th>
			<th>Denda</th>
			<th id="label-opsi3">Opsi</th>
		</tr>
		<?php
		$q_transaksi=mysqli_query($con,
			"SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
			FROM tbtransaksi,tbanggota,tbbuku
			WHERE tbtransaksi.idanggota=tbanggota.idanggota
			AND tbtransaksi.idbuku=tbbuku.idbuku
			AND tbtransaksi.tglkembali='0000-00-00'
			ORDER BY tbtransaksi.idtransaksi ASC"
		);
		$nomor=1;
		
		while($r_transaksi=mysqli_fetch_array($q_transaksi)){
		//$tgll = date('Y-m-d'); 
		$today_time = strtotime($tgll);
		$expire_time = strtotime($r_transaksi['deadline']);
		?>
		<tr <?php if ($expire_time < $today_time) { echo "style='background-color:red;color:white;'"; }else{echo"";} ?> >
			<td><?php echo $nomor++; ?></td>
			<td><?php echo $r_transaksi['idanggota']; ?></td>
			<td><?php echo $r_transaksi['nama']; ?></td>
			<td><?php echo $r_transaksi['idbuku']; ?></td>
			<td><?php echo $r_transaksi['judulbuku']; ?></td>
			<td><?php echo $r_transaksi['tglpinjam']; ?></td>
			<td><?php echo $r_transaksi['deadline']; ?></td>
			<td>Rp.<?= $r_transaksi['denda'] == '' ? '0' : $r_transaksi['denda'] ?></td>
			<td style="width:200px;">

				
					<a href="index.php?p=edit&id=<?php echo $r_transaksi['idtransaksi'];?>" class="tombol">Edit</a>
					<a href="cetak/nota-peminjaman.php?&id=<?php echo $r_transaksi['idtransaksi'];?>" target="_blank" class="tombol">Cetak Nota</a><a href="index.php?p=pengembalian&id=<?php echo $r_transaksi['idtransaksi'];?>" class="tombol">Pengembalian</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>