<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include "../koneksi.php";

if(isset($_POST['simpan'])){
mysqli_query($koneksi,"INSERT INTO jadwal VALUES(
NULL,
'$_POST[peserta]',
'$_POST[instruktur]',
'$_POST[mobil]',
'$_POST[tanggal]',
'$_POST[jam]',
'$_POST[status]'
)");
header("Location: jadwal.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Jadwal</title>
<style>
body{
background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg');background-size:cover;font-family:Arial}
.form{width:420px;margin:60px auto;background:white;padding:25px;border-radius:12px}
input,select,button{width:100%;padding:8px;margin-bottom:10px}
button{background:#28a745;color:white;border:none;border-radius:6px}
</style>
</head>

<body>
<div class="form">
<h3>Tambah Jadwal Kursus</h3>
<form method="post">

<select name="peserta">
<?php $p=mysqli_query($koneksi,"SELECT * FROM peserta");
while($r=mysqli_fetch_assoc($p)){ ?>
<option value="<?= $r['peserta_id'] ?>"><?= $r['nama_peserta'] ?></option>
<?php } ?>
</select>

<select name="instruktur">
<?php $i=mysqli_query($koneksi,"SELECT * FROM instruktur");
while($r=mysqli_fetch_assoc($i)){ ?>
<option value="<?= $r['instruktur_id'] ?>"><?= $r['nama_instruktur'] ?></option>
<?php } ?>
</select>

<select name="mobil">
<?php $m=mysqli_query($koneksi,"SELECT * FROM mobil WHERE status='Tersedia'");
while($r=mysqli_fetch_assoc($m)){ ?>
<option value="<?= $r['mobil_id'] ?>"><?= $r['nama_mobil'] ?></option>
<?php } ?>
</select>

<input type="date" name="tanggal" required>
<input type="time" name="jam" required>

<select name="status">
<option>Terjadwal</option>
<option>Selesai</option>
</select>

<button name="simpan">Simpan</button>
</form>
</div>
</body>
</html>
