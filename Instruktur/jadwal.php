<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='instruktur') {
    header("Location: ../login.php");
    exit;
}
include "../koneksi.php";
$instruktur_id = $_SESSION['instruktur_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Jadwal Peserta</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:
        linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
        url('../assets/img/bg_kursus.jpg') center/cover fixed;
}

.container{
    width:90%;
    max-width:1100px;
    margin:60px auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,.3);
}

h2{
    text-align:center;
    color:#1e90ff;
    margin-bottom:25px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1e90ff;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f4f9ff;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;
}

.pending{ background:#ff9800; color:white; }
.setuju{ background:#4caf50; color:white; }
.tolak{ background:#f44336; color:white; }

.btn{
    padding:7px 14px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    font-size:14px;
}

.btn-yes{
    background:#4caf50;
    color:white;
}

.btn-no{
    background:#f44336;
    color:white;
}

.btn:hover{
    opacity:.85;
}
</style>
</head>

<body>

<div class="container">
<h2><i class="fa fa-calendar-check"></i> Jadwal Peserta</h2>

<table>
<tr>
    <th>Peserta</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Approval</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi,"
SELECT j.*, p.nama_peserta
FROM jadwal j
JOIN peserta p ON j.peserta_id = p.peserta_id
WHERE j.instruktur_id = '$instruktur_id'
ORDER BY j.tanggal ASC
");

while($j = mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $j['nama_peserta'] ?></td>
<td><?= date('d-m-Y', strtotime($j['tanggal'])) ?></td>
<td><?= substr($j['jam'],0,5) ?></td>
<td>
<?php
if($j['approval']=='pending'){
    echo '<span class="badge pending">Pending</span>';
}elseif($j['approval']=='disetujui'){
    echo '<span class="badge setuju">Disetujui</span>';
}else{
    echo '<span class="badge tolak">Ditolak</span>';
}
?>
</td>

<td>
<?php if($j['approval']=='pending'){ ?>
    <a class="btn btn-yes"
       href="update_jadwal.php?id=<?= $j['jadwal_id'] ?>&aksi=setuju">
       <i class="fa fa-check"></i> Setujui
    </a>

    <a class="btn btn-no"
       href="update_jadwal.php?id=<?= $j['jadwal_id'] ?>&aksi=tolak"
       onclick="return confirm('Tolak jadwal ini?')">
       <i class="fa fa-times"></i> Tolak
    </a>
<?php } else { ?>
    ✔
<?php } ?>
</td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
