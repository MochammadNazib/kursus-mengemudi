<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php"); exit;
}
include "../koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Jadwal Kursus</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{
    background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg');
    background-size:cover;
}
.navbar{
    background:#1e90ff;color:white;
    padding:15px 25px;display:flex;
    justify-content:space-between;
}
.navbar a{color:white;text-decoration:none;margin-left:15px;font-weight:bold}
.container{padding:30px}
.card{background:white;padding:25px;border-radius:12px}
table{width:100%;border-collapse:collapse}
th{background:#1e90ff;color:white;padding:10px}
td{padding:10px;text-align:center;border-bottom:1px solid #ddd}
.btn{padding:7px 10px;color:white;border-radius:5px;text-decoration:none}
.add{background:#28a745}
.edit{background:orange}
.del{background:red}
</style>
</head>

<body>
<div class="navbar">
    <div><i class="fa-solid fa-calendar"></i> Jadwal Kursus</div>
    <div>
        <a href="../dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
<div class="card">
<h2>Jadwal Kursus</h2>

<a href="add.php" class="btn add">+ Tambah Jadwal</a><br><br>

<table>
<tr>
    <th>No</th>
    <th>Peserta</th>
    <th>Instruktur</th>
    <th>Mobil</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$q = mysqli_query($koneksi,"
SELECT j.*, 
p.nama_peserta, 
i.nama_instruktur, 
m.nama_mobil
FROM jadwal j
JOIN peserta p ON j.peserta_id=p.peserta_id
JOIN instruktur i ON j.instruktur_id=i.instruktur_id
JOIN mobil m ON j.mobil_id=m.mobil_id
");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama_peserta'] ?></td>
<td><?= $d['nama_instruktur'] ?></td>
<td><?= $d['nama_mobil'] ?></td>
<td><?= $d['tanggal'] ?></td>
<td><?= $d['jam'] ?></td>
<td><?= $d['status'] ?></td>
<td>
<a class="btn edit" href="edit.php?id=<?= $d['jadwal_id'] ?>">Edit</a>
<a class="btn del" href="hapus.php?id=<?= $d['jadwal_id'] ?>"
onclick="return confirm('Hapus jadwal?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
</body>
</html>
