<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='peserta') {
    header("Location: ../login.php");
    exit;
}

include "../koneksi.php";

$jadwal_id = $_POST['jadwal_id'];
$total     = $_POST['total'];
$metode    = $_POST['metode'];
$bank      = $_POST['bank'] ?? null;
$peserta_id = $_SESSION['peserta_id'];

// VALIDASI JADWAL MILIK PESERTA & SUDAH DISETUJUI
$cek = mysqli_query($koneksi,"
    SELECT * FROM jadwal 
    WHERE jadwal_id='$jadwal_id'
    AND peserta_id='$peserta_id'
    AND approval='disetujui'
");

if(mysqli_num_rows($cek)==0){
    echo "<script>
        alert('Jadwal tidak valid!');
        window.location='jadwal.php';
    </script>";
    exit;
}

// UPDATE STATUS PEMBAYARAN
mysqli_query($koneksi,"
    UPDATE jadwal SET 
        status='lunas'
    WHERE jadwal_id='$jadwal_id'
");

// (OPSIONAL) SIMPAN KE TABEL PEMBAYARAN
mysqli_query($koneksi,"
    INSERT INTO pembayaran
    (jadwal_id, metode, bank, total, tanggal)
    VALUES
    ('$jadwal_id','$metode','$bank','$total',NOW())
");

echo "<script>
    alert('Pembayaran berhasil!');
    window.location='jadwal.php';
</script>";
