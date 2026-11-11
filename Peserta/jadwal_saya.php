<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='peserta') {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Jadwal Saya</title>
<style>
body{font-family:Arial;background:#f0f4ff;}
table{
    width:90%;
    margin:50px auto;
    background:white;
    border-collapse:collapse;
}
th,td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{background:#1e90ff;color:white;}
.status{
    padding:6px 10px;
    border-radius:6px;
    color:white;
}
.menunggu{background:orange;}
.disetujui{background:green;}
</style>
</head>
<body>

<h2 style="text-align:center;">Jadwal Kursus Saya</h2>

<table>
<tr>
<th>Tanggal</th>
<th>Jam</th>
<th>Instruktur</th>
<th>Mobil</th>
<th>Status</th>
</tr>

<?php
$q=mysqli_query($koneksi,"
SELECT j.*, i.nama_instruktur, m.nama_mobil
FROM jadwal j
JOIN instruktur i ON j.instruktur_id=i.instruktur_id
JOIN mobil m ON j.mobil_id=m.mobil_id
WHERE j.peserta_id='$_SESSION[peserta_id]'
");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $d['tanggal'] ?></td>
<td><?= $d['jam'] ?></td>
<td><?= $d['nama_instruktur'] ?></td>
<td><?= $d['nama_mobil'] ?></td>
<td>
<span class="status <?= $d['status'] ?>">
<?= $d['status'] ?>
</span>
</td>
</tr>
<?php } ?>
</table>

</body>
</html>
