<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Tes</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{
background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg');
background-size:cover;
font-family:Arial;
}
.container{
padding:30px;
}
.card{
background:white;
padding:25px;
border-radius:12px;
}
h2{color:#1e90ff;}
.btn{
padding:6px 10px;
color:white;
border-radius:6px;
text-decoration:none;
font-size:13px;
}
.add{background:#28a745;}
.edit{background:orange;}
.delete{background:red;}
table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}
th{
background:#1e90ff;
color:white;
padding:8px;
}
td{
padding:8px;
border-bottom:1px solid #ddd;
}
.soal{
    max-width: 450px;
    white-space: normal;
    word-wrap: break-word;
    line-height: 1.4;
}

</style>
</head>

<body>
<div class="container">
<div class="card">

<h2>Data Tes Online</h2>

<a href="add.php" class="btn add">
<i class="fa fa-plus"></i> Tambah Soal
</a>

<table>
<tr>
<th>No</th>
<th>Soal</th>
<th>Jawaban</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT * FROM tes");
while($t=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td class="soal"><?= $t['soal'] ?></td>

<td><?= $t['jawaban'] ?></td>
<td>
<a href="edit.php?id=<?= $t['tes_id'] ?>" class="btn edit">Edit</a>
<a href="hapus.php?id=<?= $t['tes_id'] ?>" class="btn delete"
onclick="return confirm('Hapus soal ini?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

</div>
</div>
</body>
</html>
