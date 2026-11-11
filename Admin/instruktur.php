<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Instruktur</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:
        linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
        url('../assets/img/bg_kursus.jpg');
    background-size:cover;
}
.navbar{
    background:#1e90ff;
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
}
.navbar a{color:white;text-decoration:none;font-weight:bold}
.container{padding:30px}
.card{
    background:white;
    padding:30px;
    border-radius:15px;
}
h2{color:#1e90ff}
table{width:100%;border-collapse:collapse;margin-top:15px}
th{
    background:#1e90ff;
    color:white;
    padding:10px;
}
td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
.btn{
    padding:7px 12px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    font-size:14px;
}
.btn-add{background:#28a745}
.btn-edit{background:orange}
.btn-delete{background:red}
</style>
</head>
<body>

<div class="navbar">
    <div><i class="fa fa-user-tie"></i> Data Instruktur</div>
    <a href="dashboard.php">Dashboard</a>
</div>

<div class="container">
<div class="card">

<a href="tambah_instruktur.php" class="btn btn-add">
<i class="fa fa-plus"></i> Tambah Instruktur
</a>

<table>
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>No HP</th>
    <th>Keahlian</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi,"SELECT * FROM instruktur");
while($i = mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $i['instruktur_id'] ?></td>
    <td><?= $i['nama_instruktur'] ?></td>
    <td><?= $i['no_hp'] ?></td>
    <td><?= $i['keahlian'] ?></td>
    <td>
        <a href="edit_instruktur.php?id=<?= $i['instruktur_id'] ?>" class="btn btn-edit">Edit</a>
        <a href="hapus_instruktur.php?id=<?= $i['instruktur_id'] ?>" 
           class="btn btn-delete"
           onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</div>
</div>

</body>
</html>
