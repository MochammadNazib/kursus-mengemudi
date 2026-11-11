<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='peserta') {
    header("Location: ../login.php");
    exit;
}
include "../koneksi.php";

$peserta_id = $_SESSION['peserta_id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Pilih Jadwal Kursus</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    font-family:Arial;
    background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('../assets/img/bg_kursus.jpg') center/cover;
}
.card{
    background:white;
    width:450px;
    margin:70px auto;
    padding:25px;
    border-radius:15px;
}
h2{text-align:center;color:#1e90ff;}
input,select{
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:12px;
    background:#1e90ff;
    color:white;
    border:none;
    border-radius:10px;
    font-weight:bold;
}
button:hover{background:#0d47a1;}
</style>
</head>

<body>
<div class="card">
<h2><i class="fa fa-calendar"></i> Pilih Jadwal Kursus</h2>

<form method="post" action="simpan_jadwal.php">

<input type="date" name="tanggal" required>
<input type="time" name="jam" required>

<select name="instruktur_id" required>
<option value="">-- Pilih Instruktur --</option>
<?php
$q=mysqli_query($koneksi,"SELECT * FROM instruktur");
while($i=mysqli_fetch_assoc($q)){
    echo "<option value='{$i['instruktur_id']}'>{$i['nama_instruktur']}</option>";
}
?>
</select>

<select name="mobil_id" required>
<option value="">-- Pilih Mobil --</option>
<?php
$q=mysqli_query($koneksi,"SELECT * FROM mobil");
while($m=mysqli_fetch_assoc($q)){
    echo "<option value='{$m['mobil_id']}'>{$m['nama_mobil']}</option>";
}
?>
</select>

<!-- DATA WAJIB -->
<input type="hidden" name="peserta_id" value="<?= $peserta_id ?>">
<input type="hidden" name="harga" value="250000"> <!-- contoh harga -->

<button type="submit">Simpan Jadwal</button>
</form>
</div>
</body>
</html>
