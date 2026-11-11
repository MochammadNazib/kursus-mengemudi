<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['peserta_id'])) {
    header("Location: ../login.php");
    exit;
}

$jadwal_id = $_GET['jadwal_id'] ?? '';

$q = mysqli_query($koneksi,"
    SELECT j.*, m.nama_mobil, i.nama_instruktur
    FROM jadwal j
    JOIN mobil m ON j.mobil_id = m.mobil_id
    JOIN instruktur i ON j.instruktur_id = i.instruktur_id
    WHERE j.jadwal_id='$jadwal_id'
");

$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>
<head>
<title>Pembayaran</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container card">
<h2>Pembayaran Jadwal</h2>

<table class="form-table">
<tr><th>Instruktur</th><td><?= $data['nama_instruktur'] ?></td></tr>
<tr><th>Mobil</th><td><?= $data['nama_mobil'] ?></td></tr>
<tr><th>Tanggal</th><td><?= $data['tanggal'] ?></td></tr>
<tr><th>Jam</th><td><?= $data['jam'] ?></td></tr>
<tr><th>Harga</th><td><b>Rp <?= number_format($data['harga']) ?></b></td></tr>
</table>

<hr>

<form method="post" action="proses_bayar.php" enctype="multipart/form-data">
<input type="hidden" name="jadwal_id" value="<?= $jadwal_id ?>">
<input type="hidden" name="jumlah_bayar" value="<?= $data['harga'] ?>">

<table class="form-table">
<tr>
    <th>Metode Pembayaran</th>
    <td>
        <select name="metode_bayar" required>
            <option value="">-- Pilih --</option>
            <option value="transfer">Transfer</option>
            <option value="cash">Cash</option>
            <option value="qris">QRIS</option>
        </select>
    </td>
</tr>

<tr>
    <th>Bukti Pembayaran</th>
    <td><input type="file" name="bukti" required></td>
</tr>

<tr>
    <td colspan="2" align="center">
        <button class="btn btn-save">Bayar Sekarang</button>
        <a href="dashboard.php" class="btn btn-cancel">Batal</a>
    </td>
</tr>
</table>
</form>

</div>
</body>
</html>
