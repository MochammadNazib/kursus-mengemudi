<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hasil Tes</title>
<!-- STYLE -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    margin: 0;
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
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,.1);
}

h2 {
    color: #1e90ff;
    margin-bottom: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #1e90ff;
    color: white;
    padding: 12px;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

.back {
    display: inline-block;
    margin-top: 15px;
    background: gray;
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
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
    <div><i class="fa-solid fa-chart-bar"></i> Hasil Tes Peserta</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
<div class="card">
<h2>Hasil Tes Online</h2>

<table>
<tr>
    <th>Nama Peserta</th>
    <th>Benar</th>
    <th>Salah</th>
    <th>Nilai</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>

<?php
$q = mysqli_query($koneksi,"
SELECT h.*, p.nama_peserta
FROM hasil_tes h
JOIN peserta p ON h.peserta_id = p.peserta_id
");

while ($r = mysqli_fetch_assoc($q)) {
    $status = ($r['nilai'] >= 75) ? 
        "<span style='color:green;font-weight:bold'>LULUS</span>" :
        "<span style='color:red;font-weight:bold'>TIDAK LULUS</span>";
?>
<tr>
    <td><?= $r['nama_peserta'] ?></td>
    <td><?= $r['benar'] ?></td>
    <td><?= $r['salah'] ?></td>
    <td><?= $r['nilai'] ?></td>
    <td><?= $status ?></td>
    <td><?= $r['tanggal'] ?></td>
</tr>
<?php } ?>
</table>

<a href="dashboard.php" class="back">Kembali</a>
</div>
</div>

</body>
</html>
