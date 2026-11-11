<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['peserta_id'])) {
    header("Location: ../login.php");
    exit;
}

$jadwal_id     = $_POST['jadwal_id'];
$jumlah_bayar  = $_POST['jumlah_bayar'];
$metode_bayar  = $_POST['metode_bayar'];

$folder = "../uploads/bukti/";
$file   = $_FILES['bukti']['name'];
$tmp    = $_FILES['bukti']['tmp_name'];
$nama_file = time()."_".$file;

move_uploaded_file($tmp, $folder.$nama_file);

mysqli_query($koneksi,"
    INSERT INTO pembayaran
    (jadwal_id, tanggal_bayar, jumlah_bayar, metode_bayar, status_bayar, bukti_bayar)
    VALUES
    ('$jadwal_id', NOW(), '$jumlah_bayar', '$metode_bayar', 'pending', '$nama_file')
");

mysqli_query($koneksi,"
    UPDATE jadwal SET status='menunggu konfirmasi'
    WHERE jadwal_id='$jadwal_id'
");

echo "<script>
alert('Pembayaran berhasil dikirim, menunggu konfirmasi admin');
window.location='dashboard.php';
</script>";
