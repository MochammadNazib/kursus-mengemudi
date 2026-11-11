<?php
session_start();
include "../koneksi.php";
require_once "../fpdf/fpdf.php";

$peserta_id = $_SESSION['peserta_id'];

$q = mysqli_query($koneksi,"
    SELECT p.nama_peserta, h.tanggal
    FROM hasil_tes h
    JOIN peserta p ON h.peserta_id=p.peserta_id
    WHERE h.peserta_id='$peserta_id'
      AND h.status='LULUS'
");

$data = mysqli_fetch_assoc($q);

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Helvetica','B',28);
$pdf->Cell(0,20,'SERTIFIKAT KELULUSAN',0,1,'C');

$pdf->Ln(10);
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(0,10,'Diberikan Kepada:',0,1,'C');

$pdf->Ln(5);
$pdf->SetFont('Helvetica','B',22);
$pdf->Cell(0,12,$data['nama_peserta'],0,1,'C');

$pdf->Ln(8);
$pdf->SetFont('Helvetica','',14);
$pdf->MultiCell(0,10,
"Telah dinyatakan LULUS dalam Tes Teori
Kursus Mengemudi dan dinyatakan
LAYAK melanjutkan ke tahap berikutnya.",
0,'C');

$pdf->Ln(10);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(0,10,'Tanggal: '.date('d-m-Y',strtotime($data['tanggal'])),0,1,'C');

$pdf->Ln(15);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(0,10,'Pimpinan Kursus',0,1,'R');

$pdf->Ln(20);
$pdf->Cell(0,10,'( ____________________ )',0,1,'R');

$pdf->Output();
