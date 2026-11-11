<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
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
    <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Instruktur</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ===== TARO STYLE DI SINI ===== */

.profil{
    display:flex;
    align-items:center;
    gap:25px;
    justify-content:center;
    margin-bottom:25px;
}

.foto-profil{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #1e90ff;
    box-shadow:0 6px 15px rgba(0,0,0,.25);
}

.profil-text{
    text-align:left;
}

.profil-text h2{
    color:#1e90ff;
    margin-bottom:8px;
}

.btn-upload{
    display:inline-block;
    margin-top:10px;
    background:#1e90ff;
    color:white;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
}

.btn-upload:hover{
    background:#0d47a1;
}

/* ===== SAMPAI SINI ===== */
</style>

</head>
<body>

    
</style>
</head>
<body>

<div class="navbar">
    <div><i class="fa-solid fa-car"></i> Kursus Mengemudi</div>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
<div class="card">
    <h2>Dashboard Peserta</h2>
    <p>Halo, <b><?= $_SESSION['nama_peserta']; ?></b></p>

    <div class="menu">
        <a href="tes.php"><i class="fa fa-pen"></i> Tes Online</a>
        <a href="hasil.php"><i class="fa fa-chart-bar"></i> Hasil Tes</a>
    </div>
</div>
</div>

</body>
</html>
