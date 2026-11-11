<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
      body {
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
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #1e90ff;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .btn-add {
            background: #28a745;
            display: inline-block;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #1e90ff;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .btn-edit { background: orange; }
        .btn-delete { background: red; }

        .back {
            margin-top: 15px;
            display: inline-block;
            background: gray;
        }
  .logo-center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    pointer-events: none; /* supaya klik tabel tetap jalan */
}

.logo-center img {
    width: 260px;          /* ukuran profesional */
    max-width: 80%;
    opacity: 0.15;         /* transparan */
    filter: grayscale(20%);
}


    </style>
</head>

<body>

<div class="logo-center">
    <img src="../assets/img/logo.png" alt="Logo Kursus">
</div>


<div class="navbar">
    <div><i class="fa-solid fa-car"></i> Kursus Mengemudi</div>
    <div>
        <a href="../dashboard.php">Dashboard</a>
        <a href="../peserta/tes.php">Tes Online</a>
        <a href="../peserta/hasil.php">Hasil Tes</a>
        <a href="../logout.php">Logout</a>
</div>

    </div>
</div>

<div class="container">
    <div class="card">
        <h2>Data Peserta</h2>

        <a href="add.php" class="btn btn-add">
            <i class="fa-solid fa-user-plus"></i> Tambah Peserta
        </a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>

            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM peserta");
            if(!$query){
                die("QUERY ERROR: ".mysqli_error($koneksi));
            }

            while($p = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?= $p['peserta_id']; ?></td>
                <td><?= $p['nama_peserta']; ?></td>
                <td><?= $p['username']; ?></td>
                <td><?= $p['password']; ?></td>
                <td><?= $p['no_hp']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $p['peserta_id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $p['peserta_id']; ?>" class="btn btn-delete"
                       onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <a href="../dashboard.php" class="btn back">Kembali</a>
    </div>
</div>

</body>
</html>
