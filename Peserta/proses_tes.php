<?php
session_start();
include "../koneksi.php";

$peserta_id = $_SESSION['peserta_id'];
$jawaban = $_POST['jawaban'];

$benar = 0;
$salah = 0;

foreach ($jawaban as $tes_id => $jawab) {

    $q = mysqli_query($koneksi,
        "SELECT jawaban FROM tes WHERE tes_id='$tes_id'"
    );

    $data = mysqli_fetch_assoc($q);

    if (strtoupper(trim($jawab)) === strtoupper(trim($data['jawaban']))) {
        $benar++;
    } else {
        $salah++;
    }
}

$total_soal = $benar + $salah;
$nilai = ($total_soal > 0) ? round(($benar / $total_soal) * 100) : 0;

// 🔥 SIMPAN KE TABEL YANG BENAR
mysqli_query($koneksi,"
INSERT INTO hasil_tes
(peserta_id, benar, salah, nilai, tanggal)
VALUES
('$peserta_id','$benar','$salah','$nilai',NOW())
");

header("Location: hasil.php");
exit;
