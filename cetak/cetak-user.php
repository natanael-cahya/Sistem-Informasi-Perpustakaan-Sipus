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
$pdf->Cell(187,6,'Laporan Data Petugas',0,1,'C');
$pdf->Ln(1);	
$pdf->setFont('Arial','B',8);
$pdf->Cell(187,4,'Tanggal Cetak '.$tgl,0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(8,6,'No',1,0,'L',1);
$pdf->Cell(20,6,'ID Petugas',1,0,'L',1);
$pdf->Cell(65,6,'Nama Lengkap',1,0,'L',1);
$pdf->Cell(97,6,'Alamat',1,1,'L',1);

$nomor=0;
$sql=mysqli_query($con,"SELECT * FROM tbuser");
while($data=mysqli_fetch_array($sql)){
	$nomor++;
	$pdf->Ln(0);
	$pdf->setFont('Arial','',7);
	$pdf->Cell(8,4,$nomor,1,0,'L');
	$pdf->Cell(20,4,$data['iduser'],1,0,'L');
	$pdf->Cell(65,4,$data['nama'],1,0,'L');
	$pdf->Cell(97,4,$data['alamat'],1,1,'L');
}
$pdf->Output('cetak-user.pdf','I');
?>			