<?php
require('../fpdf/fpdf.php');
include "../koneksi.php";

// keamanan
if(!isset($_GET['hasil_id'])){
    die("Akses tidak valid");
}

$hasil_id = $_GET['hasil_id'];

// ambil data hasil + peserta
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT h.*, p.nama_peserta
    FROM hasil h
    JOIN peserta p ON h.peserta_id = p.peserta_id
    WHERE h.hasil_id='$hasil_id' AND h.status='lulus'
"));

if(!$data){
    die("Sertifikat hanya untuk peserta yang LULUS");
}

// ================== PDF ==================
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

// background (opsional)
$pdf->SetFillColor(245,247,250);
$pdf->Rect(0,0,297,210,'F');

// border
$pdf->SetDrawColor(30,144,255);
$pdf->SetLineWidth(2);
$pdf->Rect(10,10,277,190);

// judul
$pdf->SetFont('Arial','B',28);
$pdf->SetTextColor(30,144,255);
$pdf->Cell(0,30,'SERTIFIKAT KELULUSAN',0,1,'C');

$pdf->Ln(5);

// teks
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,12,'Diberikan kepada:',0,1,'C');

$pdf->Ln(3);

// nama
$pdf->SetFont('Arial','B',24);
$pdf->Cell(0,15,strtoupper($data['nama_peserta']),0,1,'C');

$pdf->Ln(5);

// keterangan
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,10,
    "Telah dinyatakan LULUS dalam Tes Kursus Mengemudi\n".
    "dengan hasil sebagai berikut:",
    0,'C'
);

$pdf->Ln(5);

// nilai
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Nilai Akhir : ".$data['nilai'],0,1,'C');

$pdf->Ln(5);

// tanggal
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,
    "Tanggal Lulus : ".date('d M Y',strtotime($data['tanggal'])),
    0,1,'C'
);

// tanda tangan
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Instruktur / Admin',0,1,'R');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'( Kursus Mengemudi )',0,1,'R');

$pdf->Output("I","Sertifikat_".$data['nama_peserta'].".pdf");
