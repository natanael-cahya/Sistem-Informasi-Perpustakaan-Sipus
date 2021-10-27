<?php
include'../koneksi.php';
include'../fpdf181/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P','A4');

$tgl=date('Y/m/d');
$pdf->setFont('Arial','B',12);
$pdf->Image('../images/n.jpg',10,8,20,19);
$pdf->Cell(187,6,'PERPUSTAKAAN UMUM',0,1,'C');
$pdf->setFont('Arial','B',8);
$pdf->Cell(187,6,'---------------------------',0,1,'C');
$pdf->SetLineWidth(0.3);
$pdf->Line(10,28,200,28);
$pdf->setFont('Arial','B',10);
$pdf->Cell(187,6,'Laporan Transaksi Peminjaman dan Pengembalian Buku',0,1,'C');
$pdf->Ln(1);	
$pdf->setFont('Arial','B',8);
$pdf->Cell(187,4,'Tanggal Cetak '.$tgl,0,1,'C');
		
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(6,6,'No',1,0,'L',1);
$pdf->Cell(21,6,'ID Transaksi',1,0,'L',1);
$pdf->Cell(17,6,'ID Anggota',1,0,'L',1);
$pdf->Cell(33,6,'Nama',1,0,'L',1);
$pdf->Cell(23,6,'Judul Buku',1,0,'L',1);
$pdf->Cell(40,6,'Tanggal Deadline',1,0,'L',1);
$pdf->Cell(25,6,'Tanggal Kembali',1,0,'L',1);
$pdf->Cell(24,6,'Denda',1,1,'L',1);

$nomor=0;
$q_transaksi=mysqli_query($con,
	"SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
	FROM tbtransaksi,tbanggota,tbbuku
	WHERE tbtransaksi.idanggota=tbanggota.idanggota
	AND tbtransaksi.idbuku=tbbuku.idbuku
	ORDER BY tbtransaksi.idtransaksi DESC"
);
while($r_transaksi=mysqli_fetch_array($q_transaksi)){
	$nomor++;
	$pdf->Ln(0);
	$pdf->setFont('Arial','',7);
	$pdf->Cell(6,4,$nomor,1,0,'L');
	$pdf->Cell(21,4,$r_transaksi['idtransaksi'],1,0,'L');
	$pdf->Cell(17,4,$r_transaksi['idanggota'],1,0,'L');
	$pdf->Cell(33,4,$r_transaksi['nama'],1,0,'L');
	$pdf->Cell(23,4,$r_transaksi['judulbuku'],1,0,'L');
	$pdf->Cell(40,4,$r_transaksi['deadline'],1,0,'L');
	$pdf->Cell(25,4,$r_transaksi['tglkembali'] == '0000-00-00' ? 'Belum Kembali' : $r_transaksi['tglkembali'],1,0,'L');
	$pdf->Cell(24,4,$r_transaksi['denda'] ,1,1,'L');
	
}
	
$pdf->Output('cetak-transaksi-peminjaman-pengembalian.pdf','I');
?>			