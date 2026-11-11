<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'peserta') {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$q = mysqli_query($koneksi,"
    SELECT * FROM hasil_tes 
    WHERE peserta_id='$_SESSION[peserta_id]'
    ORDER BY tanggal DESC
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

// jika belum ada hasil
if(!$data){
    echo "<script>alert('Hasil tes belum tersedia');location='dashboard.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hasil Tes</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg') center/cover;
}
.card{
    background:white;
    width:500px;
    margin:80px auto;
    padding:30px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}
h2{color:#1e90ff;}
.nilai{
    font-size:40px;
    font-weight:bold;
    color:<?= ($data['nilai'] >= 70) ? 'green' : 'red' ?>;
}
a{
    display:block;
    margin-top:20px;
    padding:12px;
    background:#1e90ff;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}
a:hover{background:#0d47a1;}
.status{
    font-weight:bold;
    margin-top:10px;
    color:<?= ($data['nilai'] >= 70) ? 'green' : 'red' ?>;
}
</style>
</head>

<body>
<div class="card">
<h2><i class="fa fa-chart-bar"></i> Hasil Tes</h2>

<p>Nama: <b><?= $_SESSION['nama_peserta'] ?></b></p>
<p>Benar: <?= $data['benar'] ?></p>
<p>Salah: <?= $data['salah'] ?></p>

<div class="nilai"><?= $data['nilai'] ?></div>
<div class="status">
    <?= ($data['nilai'] >= 70) ? 'LULUS' : 'TIDAK LULUS' ?>
</div>

<?php if($data['nilai'] >= 70){ ?>
    <a href="cetak_sertifikat.php" target="_blank">
        <i class="fa fa-print"></i> Cetak Sertifikat
    </a>
<?php } ?>

<a href="dashboard.php">
    <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
</a>

</div>
</body>
</html>
