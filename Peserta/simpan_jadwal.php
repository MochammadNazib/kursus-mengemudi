<?php
session_start();
include "../koneksi.php";

if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

$peserta_id   = $_POST['peserta_id'];
$instruktur   = $_POST['instruktur_id'];
$mobil        = $_POST['mobil_id'];
$tanggal      = $_POST['tanggal'];
$jam          = $_POST['jam'];
$harga        = $_POST['harga'];

$query = mysqli_query($koneksi, "
    INSERT INTO jadwal 
    (peserta_id, instruktur_id, mobil_id, tanggal, jam, status, harga)
    VALUES
    ('$peserta_id','$instruktur','$mobil','$tanggal','$jam','belum','$harga')
");

if ($query) {
    echo "<script>
        alert('Jadwal berhasil disimpan, silakan bayar!');
        window.location='jadwal.php';
    </script>";
} else {
    echo "Gagal simpan jadwal";
}
