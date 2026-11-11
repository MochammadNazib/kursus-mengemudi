<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'peserta') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Peserta</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:
    linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg') center/cover;
}
.navbar{
    background:#1e90ff;
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
}
.container{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:85vh;
}
.card{
    background:white;
    padding:30px;
    border-radius:15px;
    width:500px;
    text-align:center;
}
.menu a{
    display:block;
    margin:15px 0;
    padding:15px;
    background:#1e90ff;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}
.menu a:hover{background:#0d47a1;}
</style>
</head>
<body>

<div class="navbar">
<div><i class="fa fa-car"></i> Peserta</div>
<a href="../logout.php" style="color:white;">Logout</a>
</div>

<div class="container">
<div class="card">
<h2>Dashboard Peserta</h2>
<p>Halo, <b><?= $_SESSION['nama_peserta'] ?></b></p>

<div class="menu">
    <a href="jadwal.php"><i class="fa fa-calendar"></i> Jadwal Kursus</a>
    <a href="tes.php"><i class="fa fa-pen"></i> Tes Online</a>
    <a href="hasil.php"><i class="fa fa-chart-bar"></i> Hasil Tes</a>
    <a href="pilih_jadwal.php"><i class="fa fa-calendar"></i> Pilih Jadwal Kursus</a>
    
</div>



</div>
</div>

</body>
</html>
