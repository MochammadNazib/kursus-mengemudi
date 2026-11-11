<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Redirect ke dashboard sesuai role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: Admin/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == 'instruktur') {
        header("Location: Instruktur/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == 'peserta') {
        header("Location: Peserta/dashboard.php");
        exit;
    }
}

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
      body {
    background:
        linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
        url('assets/img/bg_kursus.jpg');
    background-size: cover;
    background-position: center;
}


        .box {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #1e90ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        a:hover {
            background: #0d47a1;
        }

        .logout {
            background: red;
        }
        .logo-center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    pointer-events: none;
}

.logo-center img {
    width: 260px;
    max-width: 80%;
    opacity: 0.15;
    filter: grayscale(20%);
}
.content {
    position: relative;
    z-index: 5;
    text-align: center;
}


    </style>
</head>
<body>
<div class="logo-center">
    <img src="assets/img/logo.png" alt="Logo Kursus">
</div>

<div class="box">
    <h2>Dashboard</h2>
    <p>Selamat datang, <b><?php 
        if(isset($_SESSION['username'])) {
            echo $_SESSION['username'];
        } elseif(isset($_SESSION['nama_peserta'])) {
            echo $_SESSION['nama_peserta'];
        } elseif(isset($_SESSION['nama_instruktur'])) {
            echo $_SESSION['nama_instruktur'];
        } else {
            echo "Pengguna";
        }
    ?></b></p>

    <a href="admin/admin.php">Data Admin</a>
    <a href="instruktur/instruktur.php">Data Instruktur</a>
    <a href="peserta/peserta.php">Data Peserta</a>
    <a href="mobil/mobil.php">Data Mobil</a>
    <a href="jadwal/jadwal.php">Jadwal Kursus</a>
    <a href="tes/tes.php">Tes Online</a>
    <a href="hasil/hasil_tes.php">Hasil Tes</a>


    <a href="logout.php" class="logout">Logout</a>
</div>


</body>
</html>
