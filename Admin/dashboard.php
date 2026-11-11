<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    margin:0;
    font-family: Arial;
    background:
        linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
        url('../assets/img/bg_kursus.jpg');
    background-size: cover;
    background-position: center;
}

.navbar {
    background: #1e90ff;
    color: white;
    padding: 15px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-weight: bold;
}

.container {
    padding: 30px;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,.1);
}

h2 {
    color: #1e90ff;
    margin-bottom: 20px;
    text-align: center;
}

.menu {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.menu a {
    background: #1e90ff;
    color: white;
    padding: 18px;
    border-radius: 12px;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.menu a i {
    font-size: 28px;
    margin-bottom: 8px;
    display: block;
}

.menu a:hover {
    background: #0d47a1;
    transform: translateY(-5px);
}

.logo-center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.12;
    z-index: 0;
}
.logo-center img {
    width: 260px;
}
</style>
</head>

<body>

<div class="logo-center">
    <img src="../assets/img/logo.png">
</div>

<div class="navbar">
    <div><i class="fa-solid fa-car"></i> Admin Dashboard</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
<div class="card">

<h2>Menu Admin</h2>

<div class="menu">
    <a href="admin.php"><i class="fa fa-user-shield"></i> Data Admin</a>
    <a href="../peserta/peserta.php"><i class="fa fa-users"></i> Data Peserta</a>
    <a href="instruktur.php"><i class="fa fa-user-tie"></i> Data Instruktur</a>
    <a href="../mobil/mobil.php"><i class="fa fa-car"></i> Data Mobil</a>
    <a href="jadwal.php"><i class="fa fa-calendar"></i> Jadwal Kursus</a>
    <a href="soal_tes.php"><i class="fa fa-pen"></i> Soal Tes</a>
    <a href="hasil.php"><i class="fa fa-chart-bar"></i> Hasil Tes</a>
</div>

</div>
</div>

</body>
</html>
