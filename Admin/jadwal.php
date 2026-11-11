<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='admin') {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";

/* APPROVE / TOLAK */
if (isset($_GET['aksi'])) {
    $status = $_GET['aksi'];
    $id = $_GET['id'];
    mysqli_query($koneksi,"UPDATE jadwal SET status='$status' WHERE jadwal_id='$id'");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Kelola Jadwal</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{
font-family:Arial;
background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
url('../assets/img/bg_kursus.jpg') center/cover fixed;
}
.card{
background:white;
width:95%;
margin:40px auto;
padding:25px;
border-radius:15px;
}
h2{text-align:center;color:#1e90ff;}
table{width:100%;border-collapse:collapse;}
th{
background:#1e90ff;
color:white;
padding:10px;
}
td{
padding:10px;
text-align:center;
border-bottom:1px solid #ddd;
}
.btn{
padding:6px 10px;
border-radius:6px;
color:white;
text-decoration:none;
font-size:14px;
}
.setuju{background:green;}
.tolak{background:red;}
.status{
padding:5px 10px;
border-radius:6px;
color:white;
}
.menunggu{background:orange;}
.disetujui{background:green;}
.ditolak{background:red;}
</style>
</head>

<body>
<div class="card">
<h2><i class="fa fa-calendar"></i> Approval Jadwal Kursus</h2>

<table>
<tr>
<th>Peserta</th>
<th>Instruktur</th>
<th>Mobil</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php
$q=mysqli_query($koneksi,"
SELECT j.*, p.nama_peserta, i.nama_instruktur, m.nama_mobil
FROM jadwal j
JOIN peserta p ON j.peserta_id=p.peserta_id
JOIN instruktur i ON j.instruktur_id=i.instruktur_id
JOIN mobil m ON j.mobil_id=m.mobil_id
ORDER BY j.tanggal DESC
");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $d['nama_peserta'] ?></td>
<td><?= $d['nama_instruktur'] ?></td>
<td><?= $d['nama_mobil'] ?></td>
<td><?= $d['tanggal'] ?></td>
<td><?= $d['jam'] ?></td>
<td><span class="status <?= $d['status'] ?>"><?= $d['status'] ?></span></td>
<td>
<?php if($d['status']=='menunggu'){ ?>
<a class="btn setuju" href="?aksi=disetujui&id=<?= $d['jadwal_id'] ?>">Setujui</a>
<a class="btn tolak" href="?aksi=ditolak&id=<?= $d['jadwal_id'] ?>">Tolak</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
