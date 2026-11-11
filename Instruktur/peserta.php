<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'instruktur') {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
$instruktur_id = $_SESSION['instruktur_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Peserta Saya</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:
        linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
        url('../assets/img/bg_kursus.jpg') center/cover fixed;
}

.navbar{
    background:#1e90ff;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
}

.navbar a{
    color:white;
    text-decoration:none;
    font-weight:bold;
    margin-left:20px;
}

.container{
    padding:40px;
}

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.25);
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
    background:#f2f8ff;
}
</style>
</head>

<body>

<div class="navbar">
    <div>
        <i class="fa fa-users"></i> Peserta Saya
    </div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
<div class="card">

<h2>Daftar Peserta</h2>

<table>
<tr>
    <th>Nama Peserta</th>
    <th>No HP</th>
    <th>Status Jadwal</th>
</tr>

<?php
$query = mysqli_query($koneksi, "
    SELECT DISTINCT 
        p.nama_peserta,
        p.no_hp,
        j.status
    FROM jadwal j
    JOIN peserta p ON j.peserta_id = p.peserta_id
    WHERE j.instruktur_id = '$instruktur_id'
");

if (!$query) {
    echo "<tr><td colspan='3'>Query Error</td></tr>";
} elseif (mysqli_num_rows($query) == 0) {
    echo "<tr><td colspan='3'>Belum ada peserta</td></tr>";
} else {
    while ($p = mysqli_fetch_assoc($query)) {
        echo "
        <tr>
            <td>{$p['nama_peserta']}</td>
            <td>{$p['no_hp']}</td>
            <td>{$p['status']}</td>
        </tr>";
    }
}
?>

</table>

</div>
</div>

</body>
</html>
